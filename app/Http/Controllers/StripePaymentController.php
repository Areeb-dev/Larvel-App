<?php

namespace App\Http\Controllers;


use App\Invoice;
use App\InvoicePayment;
use App\Transaction;
use App\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Stripe;

class StripePaymentController extends Controller
{
    public $settings;


    public function index()
    {
        $objUser = \Auth::user();
        if($objUser->type == 'super admin')
        {
            $orders = Order::select(
                [
                    'orders.*',
                    'users.name as user_name',
                ]
            )->join('users', 'orders.user_id', '=', 'users.id')->orderBy('orders.created_at', 'DESC')->get();
        }
        else
        {
            $orders = Order::select(
                [
                    'orders.*',
                    'users.name as user_name',
                ]
            )->join('users', 'orders.user_id', '=', 'users.id')->orderBy('orders.created_at', 'DESC')->where('users.id', '=', $objUser->id)->get();
        }

        return view('order.index', compact('orders'));
    }


    public function addPayment(Request $request, $id)
    {

        $invoice = Invoice::find($id);
        $company_payment_setting = Utility::getCompanyPaymentSetting($invoice->created_by);
        $settings = DB::table('settings')->where('created_by', '=', $invoice->created_by)->get()->pluck('value', 'name');


        if($invoice)
        {
            if($request->amount > $invoice->getDue())
            {
                return redirect()->back()->with('error', __('Invalid amount.'));
            }
            else
            {
                try
                {

                    $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
                    $price   = $request->amount;
                    Stripe\Stripe::setApiKey($company_payment_setting['stripe_secret']);

                    $data = Stripe\Charge::create(
                        [
                            "amount" => 100 * $price,
                            "currency" => Utility::getValByName('site_currency'),
                            "source" => $request->stripeToken,
                            "description" => 'Invoice ' . Utility::invoiceNumberFormat($settings, $invoice->invoice_id),
                            "metadata" => ["order_id" => $orderID],
                        ]
                    );

                    if($data['amount_refunded'] == 0 && empty($data['failure_code']) && $data['paid'] == 1 && $data['captured'] == 1)
                    {
                        $payments = InvoicePayment::create(
                            [

                                'invoice_id' => $invoice->id,
                                'date' => date('Y-m-d'),
                                'amount' => $price,
                                'account_id' => 0,
                                'payment_method' => 0,
                                'order_id' => $orderID,
                                'currency' => $data['currency'],
                                'txn_id' => $data['balance_transaction'],
                                'payment_type' => __('STRIPE'),
                                'receipt' => $data['receipt_url'],
                                'reference' => '',
                                'description' => 'Invoice ' . Utility::invoiceNumberFormat($settings, $invoice->invoice_id),
                            ]
                        );

                        if($invoice->getDue() <= 0)
                        {
                            $invoice->status = 4;
                        }
                        elseif(($invoice->getDue() - $request->amount) == 0)
                        {
                            $invoice->status = 4;
                        }
                        else
                        {
                            $invoice->status = 3;
                        }
                        $invoice->save();

                        $invoicePayment              = new Transaction();
                        $invoicePayment->user_id     = $invoice->customer_id;
                        $invoicePayment->user_type   = 'Customer';
                        $invoicePayment->type        = 'STRIPE';
                        $invoicePayment->created_by  = $invoice->invoice_id;
                        $invoicePayment->payment_id  = $invoicePayment->id;
                        $invoicePayment->category    = 'Invoice';
                        $invoicePayment->amount      = $price;
                        $invoicePayment->date        = date('Y-m-d');
                        $invoicePayment->payment_id  = $payments->id;
                        $invoicePayment->description = 'Invoice ' . Utility::invoiceNumberFormat($settings, $invoice->invoice_id);
                        $invoicePayment->account     = 0;
                        Transaction::addTransaction($invoicePayment);

                        Utility::userBalance('customer', $invoice->customer_id, $request->amount, 'debit');

                        Utility::bankAccountBalance($request->account_id, $request->amount, 'credit');

                        return redirect()->back()->with('success', __(' Payment successfully added.'));
                    }
                    else
                    {
                        return redirect()->back()->with('error', __('Transaction has been failed.'));
                    }
                }
                catch(\Exception $e)
                {

                    return redirect()->back()->with('error', __($e->getMessage()));
                }
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
