<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\InvoicePayment;
use App\User;
use App\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PaystackPaymentController extends Controller
{
    //
    public    $secret_key;
    public    $public_key;
    public    $is_enabled;
    protected $invoiceData;


    public function paymentConfig()
    {
        $payment_setting = Utility::getCompanyPaymentSetting($this->invoiceData->created_by);

        $this->secret_key = isset($payment_setting['paystack_secret_key']) ? $payment_setting['paystack_secret_key'] : '';
        $this->public_key = isset($payment_setting['paystack_public_key']) ? $payment_setting['paystack_public_key'] : '';
        $this->is_enabled = isset($payment_setting['is_paystack_enabled']) ? $payment_setting['is_paystack_enabled'] : 'off';
    }



    public function customerPayWithPaystack(Request $request)
    {

        $invoiceID = \Illuminate\Support\Facades\Crypt::decrypt($request->invoice_id);
        $invoice   = Invoice::find($invoiceID);
        $user      = User::find($invoice->created_by);


        if($invoice)
        {
            $price = $request->amount;
            if($price > 0)
            {
                $res_data['email']       = $user->email;
                $res_data['total_price'] = $price;
                $res_data['currency']    = Utility::getValByName('site_currency');
                $res_data['flag']        = 1;

                return $res_data;

            }
            else
            {
                $res['msg']  = __("Enter valid amount.");
                $res['flag'] = 2;

                return $res;
            }

        }
        else
        {
            return redirect()->back()->with('error', __('Invoice is deleted.'));

        }

    }

    public function getInvoicePaymentStatus(Request $request, $pay_id, $invoice_id)
    {
        $invoiceID         = \Illuminate\Support\Facades\Crypt::decrypt($invoice_id);
        $invoice           = Invoice::find($invoiceID);
        $this->invoiceData = $invoice;
        $payment           = $this->paymentConfig();
        $orderID           = strtoupper(str_replace('.', '', uniqid('', true)));
        $settings          = DB::table('settings')->where('created_by', '=', $invoice->created_by)->get()->pluck('value', 'name');


        $result = array();

        if($invoice)
        {
            try
            {

                //The parameter after verify/ is the transaction reference to be verified
                $url = "https://api.paystack.co/transaction/verify/$pay_id";
                $ch  = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt(
                    $ch, CURLOPT_HTTPHEADER, [
                           'Authorization: Bearer ' . $this->secret_key,
                       ]
                );
                $responce = curl_exec($ch);
                curl_close($ch);
                if($responce)
                {
                    $result = json_decode($responce, true);
                }

                if(isset($result['status']) && $result['status'] == true)
                {

                    $payments = InvoicePayment::create(
                        [
                            'invoice_id' => $invoice->id,
                            'date' => date('Y-m-d'),
                            'amount' => $request->amount,
                            'payment_method' => 1,
                            'order_id' => $orderID,
                            'payment_type' => __('Paystack'),
                            'receipt' => '',
                            'description' => __('Invoice') . ' ' . Utility::invoiceNumberFormat($settings, $invoice->invoice_id),
                        ]
                    );

                    $invoice = Invoice::find($invoice->id);


                    if($invoice->getDue() <= 0)
                    {
                        Invoice::change_status($invoice->id, 4);
                    }
                    else
                    {
                        Invoice::change_status($invoice->id, 3);
                    }


                    return redirect()->route('invoice.link.copy', Crypt::encrypt($invoice->id))->with('success', __(' Payment successfully added.'));

                }
                else
                {

                    return redirect()->route('invoice.link.copy', Crypt::encrypt($invoice->id))->with('error', __('Transaction Unsuccesfull'));
                }
            }
            catch(\Exception $e)
            {

                return redirect()->route('invoice.link.copy', Crypt::encrypt($invoice->id))->with('error', __('Transaction has been failed.'));
            }
        }
        else
        {
            return redirect()->route('invoice.link.copy', Crypt::encrypt($invoice->id))->with('error', __('Invoice is deleted.'));
        }
    }
}
