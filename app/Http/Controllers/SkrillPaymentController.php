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
use Obydul\LaraSkrill\SkrillClient;
use Obydul\LaraSkrill\SkrillRequest;

class SkrillPaymentController extends Controller
{
    public    $email;
    public    $is_enabled;
    protected $invoiceData;

    public function paymentConfig()
    {

        $payment_setting = Utility::getCompanyPaymentSetting($this->invoiceData->created_by);

        $this->email      = isset($payment_setting['skrill_email']) ? $payment_setting['skrill_email'] : '';
        $this->is_enabled = isset($payment_setting['is_skrill_enabled']) ? $payment_setting['is_skrill_enabled'] : 'off';

        return $this;
    }



    public function customerPayWithSkrill(Request $request)
    {


        $invoiceID = \Illuminate\Support\Facades\Crypt::decrypt($request->invoice_id);
        $invoice   = Invoice::find($invoiceID);
        $user      = User::find($invoice->created_by);
        $this->invoiceData = $invoice;
        $payment = $this->paymentConfig();

        if($invoice)
        {
            $price = $request->amount;
            if($price > 0)
            {

                $tran_id             = md5(date('Y-m-d') . strtotime('Y-m-d H:i:s') . 'user_id');
                $skill               = new SkrillRequest();
                $skill->pay_to_email = $this->email;
                $skill->return_url   = route(
                    'customer.skrill', [
                                         $request->invoice_id,
                                         $price,
                                         'tansaction_id=' . MD5($tran_id),
                                     ]
                );
                $skill->cancel_url   = route(
                    'customer.skrill', [
                                         $request->invoice_id,
                                         $price,
                                     ]
                );

                // create object instance of SkrillRequest
                $skill->transaction_id  = MD5($tran_id); // generate transaction id
                $skill->amount          = $price;
                $skill->currency        = Utility::getValByName('site_currency');
                $skill->language        = 'EN';
                $skill->prepare_only    = '1';
                $skill->merchant_fields = 'site_name, customer_email';
                $skill->site_name       = $user->name;
                $skill->customer_email  = $user->email;

                // create object instance of SkrillClient
                $client = new SkrillClient($skill);
                $sid    = $client->generateSID(); //return SESSION ID

                // handle error
                $jsonSID = json_decode($sid);
                if($jsonSID != null && $jsonSID->code == "BAD_REQUEST")
                {
                    return redirect()->back()->with('error', $jsonSID->message);
                }


                // do the payment
                $redirectUrl = $client->paymentRedirectUrl($sid); //return redirect url
                if($tran_id)
                {
                    $data = [
                        'amount' => $price,
                        'trans_id' => MD5($request['transaction_id']),
                        'currency' => Utility::getValByName('site_currency'),
                    ];
                    session()->put('skrill_data', $data);
                }


                return redirect($redirectUrl);

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

    public function getInvoicePaymentStatus(Request $request, $invoice_id, $amount)
    {

        $invoiceID = \Illuminate\Support\Facades\Crypt::decrypt($invoice_id);
        $invoice   = Invoice::find($invoiceID);
        $this->invoiceData = $invoice;

        $payment  = $this->paymentConfig();
        $orderID  = strtoupper(str_replace('.', '', uniqid('', true)));
        $settings = DB::table('settings')->where('created_by', '=', $invoice->created_by)->get()->pluck('value', 'name');


        $result    = array();

        if($invoice)
        {
            try
            {

                if(session()->has('skrill_data') && isset($request->tansaction_id) && !empty($request->tansaction_id))
                {
                    $get_data = session()->get('skrill_data');

                    $payments = InvoicePayment::create(
                        [
                            'invoice_id' => $invoice->id,
                            'date' => date('Y-m-d'),
                            'amount' => $request->amount,
                            'payment_method' => 1,
                            'order_id' => $orderID,
                            'payment_type' => __('Skrill'),
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
                    return redirect()->route('invoice.link.copy', Crypt::encrypt($invoice->id))->with('error', __('Transaction has been failed! '));
                }
            }
            catch(\Exception $e)
            {
                return redirect()->route('invoice.link.copy', Crypt::encrypt($invoice->id))->with('error', __('Invoice not found!'));
            }
        }
    }
}
