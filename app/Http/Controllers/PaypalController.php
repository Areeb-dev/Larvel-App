<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\InvoicePayment;
use App\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PaypalController extends Controller
{
    private   $_api_context;
    protected $invoiceData;

    public function setApiContext()
    {

        $payment_setting = Utility::getCompanyPaymentSetting($this->invoiceData->created_by);


        $paypal_conf['settings']['mode'] = $payment_setting['paypal_mode'];
        $paypal_conf['client_id']        = $payment_setting['paypal_client_id'];
        $paypal_conf['secret_key']       = $payment_setting['paypal_secret_key'];

        $this->_api_context = new ApiContext(
            new OAuthTokenCredential(
                $paypal_conf['client_id'], $paypal_conf['secret_key']
            )
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }


    public function customerPayWithPaypal(Request $request, $invoice_id)
    {
        $invoice                 = Invoice::find($invoice_id);
        $this->invoiceData       = $invoice;
        $settings                = DB::table('settings')->where('created_by', '=', $invoice->created_by)->get()->pluck('value', 'name');


        $get_amount = $request->amount;

        $request->validate(['amount' => 'required|numeric|min:0']);


        $invoice = Invoice::find($invoice_id);

        if($invoice)
        {
            if($get_amount > $invoice->getDue())
            {
                return redirect()->back()->with('error', __('Invalid amount.'));
            }
            else
            {
                $this->setApiContext();

                $orderID = strtoupper(str_replace('.', '', uniqid('', true)));

                $name = Utility::invoiceNumberFormat($settings, $invoice->invoice_id);

                $payer = new Payer();
                $payer->setPaymentMethod('paypal');

                $item_1 = new Item();
                $item_1->setName($name)->setCurrency(Utility::getValByName('site_currency'))->setQuantity(1)->setPrice($get_amount);

                $item_list = new ItemList();
                $item_list->setItems([$item_1]);

                $amount = new Amount();
                $amount->setCurrency(Utility::getValByName('site_currency'))->setTotal($get_amount);

                $transaction = new Transaction();
                $transaction->setAmount($amount)->setItemList($item_list)->setDescription($name)->setInvoiceNumber($orderID);

                $redirect_urls = new RedirectUrls();
                $redirect_urls->setReturnUrl(
                    route(
                        'customer.get.payment.status', $invoice->id
                    )
                )->setCancelUrl(
                    route(
                        'customer.get.payment.status', $invoice->id
                    )
                );

                $payment = new Payment();
                $payment->setIntent('Sale')->setPayer($payer)->setRedirectUrls($redirect_urls)->setTransactions([$transaction]);

                try
                {

                    $payment->create($this->_api_context);
                }
                catch(\PayPal\Exception\PayPalConnectionException $ex) //PPConnectionException
                {
                    if(\Config::get('app.debug'))
                    {
                        return redirect()->back()->with('error', __('Connection timeout'));
                    }
                    else
                    {
                        return redirect()->back()->with('error', __('Some error occur, sorry for inconvenient'));
                    }
                }
                foreach($payment->getLinks() as $link)
                {
                    if($link->getRel() == 'approval_url')
                    {
                        $redirect_url = $link->getHref();
                        break;
                    }
                }
                Session::put('paypal_payment_id', $payment->getId());
                if(isset($redirect_url))
                {
                    return Redirect::away($redirect_url);
                }

                return redirect()->back()->with('error', __('Unknown error occurred'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function customerGetPaymentStatus(Request $request, $invoice_id)
    {
        $invoice                 = Invoice::find($invoice_id);
        $this->invoiceData       = $invoice;
        $settings                = DB::table('settings')->where('created_by', '=', $invoice->created_by)->get()->pluck('value', 'name');


        $this->setApiContext();

        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');

        if(empty($request->PayerID || empty($request->token)))
        {
            return redirect()->back()->with('error', __('Payment failed'));
        }

        $payment = Payment::get($payment_id, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId($request->PayerID);

        try
        {
            $result   = $payment->execute($execution, $this->_api_context)->toArray();
            $order_id = strtoupper(str_replace('.', '', uniqid('', true)));
            $status   = ucwords(str_replace('_', ' ', $result['state']));
            if($result['state'] == 'approved')
            {
                $amount = $result['transactions'][0]['amount']['total'];
            }
            else
            {
                $amount = isset($result['transactions'][0]['amount']['total']) ? $result['transactions'][0]['amount']['total'] : '0.00';
            }


            if($result['state'] == 'approved')
            {
                $payments = InvoicePayment::create(
                    [

                        'invoice_id' => $invoice->id,
                        'date' => date('Y-m-d'),
                        'amount' => $amount,
                        'account_id' => 0,
                        'payment_method' => 0,
                        'order_id' => $order_id,
                        'currency' => Utility::getValByName('site_currency'),
                        'txn_id' => $payment_id,
                        'payment_type' => __('PAYPAL'),
                        'receipt' => '',
                        'reference' => '',
                        'description' => 'Invoice ' . Utility::invoiceNumberFormat($settings, $invoice->invoice_id),
                    ]
                );

                if($invoice->getDue() <= 0)
                {
                    $invoice->status = 4;
                    $invoice->save();
                }
                elseif(($invoice->getDue() - $payments->amount) == 0)
                {
                    $invoice->status = 4;
                    $invoice->save();
                }
                else
                {
                    $invoice->status = 3;
                    $invoice->save();
                }

                $invoicePayment              = new Transaction();
                $invoicePayment->user_id     = $invoice->customer_id;
                $invoicePayment->user_type   = 'Customer';
                $invoicePayment->type        = 'PAYPAL';
                $invoicePayment->created_by  = $invoice->created_by;
                $invoicePayment->payment_id  = $invoicePayment->id;
                $invoicePayment->category    = 'Invoice';
                $invoicePayment->amount      = $amount;
                $invoicePayment->date        = date('Y-m-d');
                $invoicePayment->payment_id  = $payments->id;
                $invoicePayment->description = 'Invoice ' . Utility::invoiceNumberFormat($settings, $invoice->invoice_id);
                $invoicePayment->account     = 0;

                \App\Transaction::addTransaction($invoicePayment);

                Utility::userBalance('customer', $invoice->customer_id, $request->amount, 'debit');

                Utility::bankAccountBalance($request->account_id, $request->amount, 'credit');

                return redirect()->back()->with('success', __('Payment successfully added'));
            }
            else
            {
                return redirect()->back()->with('error', __('Transaction has been ' . $status));
            }

        }
        catch(\Exception $e)
        {

            return redirect()->back()->with('error', __('Transaction has been failed.'));
        }

    }
}
