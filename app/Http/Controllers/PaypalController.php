<?php

namespace App\Http\Controllers;


use App\Http\Traits\Paypalable;
use App\Models\Device;
use App\Models\Payments;
use App\Models\Paypal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use Alert;
use Auth;
use Response;

use PayPal\Exception\PayPalConnectionException;

class PaypalController extends Controller
{
    use Paypalable;


    /**
     * Send Payment Request To The Provider
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function pay_course(Request $request)
    {
        $this->validate($request,
            [
                'amount'=>'required|integer',
            ]);

        $user=\App\User::findOrFail(auth()->id());


        $payer_name="  ايداع " .$request['amount']."ريال سعودى" . $user->name ;
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item= new Item();
        $item->setName($payer_name)
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setSku(auth()->id()) // Similar to `item_number` in Classic API
            ->setPrice($request['amount']);
        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $details     = new Details();
        $details->setShipping(0)->setTax(0)->setSubtotal($request['amount']);


        $amount      = new Amount();
        $amount->setCurrency('USD')->setTotal($request['amount'])->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)->setItemList($itemList)->setDescription("ايداع مبلغ جديد ")->setInvoiceNumber(uniqid());

        $baseUrl =url('/');
        $redirectUrl = new RedirectUrls();
        $redirectUrl->setReturnUrl("$baseUrl/paypal/success?user_id=$user->id")->setCancelUrl("$baseUrl/paypal/canceled");


        $payment= new Payment();
        $payment->setIntent('sale')->setPayer($payer)->setRedirectUrls($redirectUrl)->setTransactions(array($transaction));
        try
        {
            $this->setApiContext();
            $payment->create($this->apiContext);

        }
        catch (PayPalConnectionException $ex) {
            echo $ex->getCode(); // Prints the Error Code
            echo $ex->getData(); // Prints the detailed error message
            dd($ex);
        } catch (\Exception $ex) {
            die($ex);
        }

        $url = $payment->getApprovalLink();

        return $url;

        if($url != null)
            return Redirect($url);

        return Redirect()->back();
    }

    public function add_to_wallet()
    {

//        $this->validate($request,
//            [
//                'amount'=>'required|integer',
//            ]);


        $user=auth()->user();
        // get commission
        $commission = number_format($user->commission,2);
        $request=$commission *  0.266667 ;
        $payer_name="  ايداع " .$request." دولار " . $user->name ;
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");
        $item= new Item();
        $item->setName($payer_name)
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setSku(auth()->id()) // Similar to `item_number` in Classic API
            ->setPrice($request);
        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $details     = new Details();
        $details->setShipping(0)->setTax(0)->setSubtotal($request);


        $amount      = new Amount();
        $amount->setCurrency('USD')->setTotal($request)->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)->setItemList($itemList)->setDescription("ايداع مبلغ جديد ")->setInvoiceNumber(uniqid());

        $baseUrl =url('/');
        $redirectUrl = new RedirectUrls();
        $redirectUrl->setReturnUrl("$baseUrl/paypal/success3?user_id=$user->id")->setCancelUrl("$baseUrl/paypal/canceled");


        $payment= new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrl)
            ->setTransactions(array($transaction));
        try
        {
            $this->setApiContext();
            $payment->create($this->apiContext);

        }
        catch (PayPalConnectionException $ex) {
            echo $ex->getCode(); // Prints the Error Code
            echo $ex->getData(); // Prints the detailed error message
            dd($ex);
        } catch (\Exception $ex) {
            die($ex);
        }

        $url = $payment->getApprovalLink();



        if($url != null)
            return Redirect($url);

        return Redirect()->back();
    }


    public function add_to_star()
    {
//        $this->validate($request,
//            [
//                'amount'=>'required|integer',
//            ]);

        $user=auth()->user();
        $request=1333;
        $payer_name="  ايداع " .$request."دولار " . $user->name ;
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item= new Item();
        $item->setName($payer_name)
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setSku(auth()->id()) // Similar to `item_number` in Classic API
            ->setPrice($request);
        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $details     = new Details();
        $details->setShipping(0)->setTax(0)->setSubtotal($request);


        $amount      = new Amount();
        $amount->setCurrency('USD')->setTotal($request)->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)->setItemList($itemList)->setDescription("ايداع مبلغ جديد ")->setInvoiceNumber(uniqid());

        $baseUrl =url('/');
        $redirectUrl = new RedirectUrls();
        $redirectUrl->setReturnUrl("$baseUrl/paypal/success2?user_id=$user->id")->setCancelUrl("$baseUrl/paypal/canceled");


        $payment= new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrl)
            ->setTransactions(array($transaction));
        try
        {
            $this->setApiContext();
            $payment->create($this->apiContext);

        }
        catch (PayPalConnectionException $ex) {
            echo $ex->getCode(); // Prints the Error Code
            echo $ex->getData(); // Prints the detailed error message
            dd($ex);
        } catch (\Exception $ex) {
            die($ex);
        }

        $url = $payment->getApprovalLink();


        if($url != null)
            return Redirect($url);

        return Redirect()->back();
    }

    /**
     * Trip Reservation
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function notifyByOneSignal($audience, $contents, $data)
    {
        // audience include_player_ids
        $appId = ['app_id' => env('ONE_SIGNAL_APP_ID')];
        $fields = json_encode((array)$appId + (array)$audience + ['contents' => (array)$contents] + ['data' => (array)$data]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ' . env('ONE_SIGNAL_KEY')));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function onProcessingCourseSuccess(Request $request)
    {
        $this->validate($request,
            [
                'paymentId'    =>'required',
                'token'        =>'required',
                'PayerID'     =>'required',
            ]);

        if($request->paymentId != '' && $request->PayerID != '' && $request->token != '')
        {
            $this->setApiContext();

            $payment = Payment::get($request->paymentId, $this->apiContext);



            $items = $payment->transactions[0]->item_list->items;
            $execution   = new PaymentExecution();
            $execution->setPayerId($request->PayerID);

            $transaction = new Transaction();
            $amount      = new Amount();
            $details     = new Details();

            $details->setTax(0)->setSubtotal($payment->transactions[0]->amount->total);

            $amount->setCurrency('USD')->setTotal($payment->transactions[0]->amount->total)->setDetails($details);

            $transaction->setAmount($amount);

            $execution->addTransaction($transaction);

            try {

//                $result = $payment->execute($execution, $this->apiContext);

                try {

                    $payment = Payment::get($request->paymentId, $this->apiContext);

                    $in = new Payments();
                    $in->type = 'visa';
                    $in->user_id =$request->user_id;
                    $in->save();

                  Paypal::create([
                        'user_id' => $request->user_id,
                        'payment_id' => $payment->id,
                        'inner_payment_id' => $in->id,
                        'status' => $payment->state,
                        'payer_first_name' => $payment->payer->payer_info->first_name,
                        'payer_last_name' => $payment->payer->payer_info->last_name,
                        'payer_email'   => $payment->payer->payer_info->email,
                        'payer_id'  => $payment->payer->payer_info->payer_id,
                        'payer_phone' => $payment->payer->payer_info->phone,
                        'amount' => $payment->transactions[0]->amount->total,
                        'payment_method' => $payment->payer->payment_method,

                    ]);

                    $transaction = new Transaction();
                    $transaction->type = 'deposit';
                    $transaction->amount = $payment->transactions[0]->amount->total;
                    $transaction->payment_id = $in->id;
                    $transaction->reason = "paypal";
                    $transaction->save();

//                    $user=User::find(auth()->id());
//                    $user->balance=$user->balance+$payment->transactions[0]->amount->total;
//
//                    $user->save();

                } catch (\Exception $e)
                {
                    $data = [
                        'data' => [
                            'status' => 0,
                            'msg' => 'حدث خطأ',
                            '$e' =>   $e,
                        ]
                    ];
                    flash()->error('   حدث  خطأ');

                    return redirect()->to('/');
                    return Response::json($data, 200);
                }

            } catch (\Exception $e) {

                $data = [
                    'data' => [
                        'status' => 0,
                        'msg' => 'حدث خطأ',
                        '$e' =>   $e,

                    ]
                ];
                flash()->error('   حدث  خطأ');
                return redirect()->to('/');
                return Response::json($data, 200);
            }

            $user_devices = Device::where('user_id', $request->user_id)->get();

            $count = 0;

            $device_token2 = array();

            foreach ($user_devices as $device) {
                $device_token2[$count] = $device->device_token;
                $count++;
            }

            $contents="تم عملية اضافة الرصيد بنجاح";
            $data = ['transaction' => $transaction->id];
            $audience = ['include_player_ids' => $device_token2];
            $this->notifyByOneSignal($audience, $contents, $data);

            $data = [
                'data' => [
                    'status' => true,
                    'msg' => 'تمت العملية بنجاح  ',
                ]
            ];

            return Response::json($data, 200);

        }
        else
        {
            return Response::json( [
                'status' => false,
                'msg' => 'تأكد من البيانات',
             ], 200);
        }
    }

    public function onProcessingCourseSuccess2(Request $request)
    {
        $this->validate($request,
            [
                'paymentId'    =>'required',
                'token'        =>'required',
                'PayerID'     =>'required',
            ]);

        if($request->paymentId != '' && $request->PayerID != '' && $request->token != '')
        {
            $this->setApiContext();

            $payment = Payment::get($request->paymentId, $this->apiContext);



            $items = $payment->transactions[0]->item_list->items;
            $execution   = new PaymentExecution();
            $execution->setPayerId($request->PayerID);

            $transaction = new Transaction();
            $amount      = new Amount();
            $details     = new Details();

            $details->setTax(0)->setSubtotal($payment->transactions[0]->amount->total);

            $amount->setCurrency('USD')->setTotal($payment->transactions[0]->amount->total)->setDetails($details);

            $transaction->setAmount($amount);

            $execution->addTransaction($transaction);

            try {

//                $result = $payment->execute($execution, $this->apiContext);

                try {

                    $payment = Payment::get($request->paymentId, $this->apiContext);

                    $in = new Payments();
                    $in->type = 'visa';
                    $in->user_id =$request->user_id;

                    $in->save();

                    Paypal::create([
                        'user_id' => $request->user_id,
                        'payment_id' => $payment->id,
                        'inner_payment_id' => $in->id,
                        'status' => $payment->state,
                        'payer_first_name' => $payment->payer->payer_info->first_name,
                        'payer_last_name' => $payment->payer->payer_info->last_name,
                        'payer_email'   => $payment->payer->payer_info->email,
                        'payer_id'  => $payment->payer->payer_info->payer_id,
                        'payer_phone' => $payment->payer->payer_info->phone,
                        'amount' => $payment->transactions[0]->amount->total,
//                        'payment_method' => $payment->payer->payment_method,

                    ]);

                    $user=User::findorFail($request->user_id);
                    $user->is_special=1;
                    $user->save();

//                    $transaction = new \App\Models\Transaction();
//                    $transaction->type = 'deposit';
//                    $transaction->amount = $payment->transactions[0]->amount->total;
//                    $transaction->payment_id = $in->id;
//                    $transaction->reason = "paypal";
//                    $transaction->save();

//                    $user=User::find(auth()->id());
//                    $user->balance=$user->balance+$payment->transactions[0]->amount->total;
//
//                    $user->save();

                } catch (\Exception $e)
                {
                    alert()->error('حد2ث خطأ ');
                    return redirect('/');
                }

             } catch (\Exception $e) {

                alert()->error('حدث خطأ ');
                return redirect('/');
            }
            $added=$payment->transactions[0]->amount->total;
            alert()->success(" تم بنجاح ترقية عضويتك");
            return redirect('/');


        }
        else
        {
            alert()->warning("خطأ");
            return redirect()->back();

        }
    }


    public function onProcessingCourseSuccess3(Request $request)
    {
        $this->validate($request,
            [
                'paymentId'    =>'required',
                'token'        =>'required',
                'PayerID'     =>'required',
            ]);

        if($request->paymentId != '' && $request->PayerID != '' && $request->token != '')
        {
            $this->setApiContext();

            $payment = Payment::get($request->paymentId, $this->apiContext);



            $items = $payment->transactions[0]->item_list->items;
            $execution   = new PaymentExecution();
            $execution->setPayerId($request->PayerID);

            $transaction = new Transaction();
            $amount      = new Amount();
            $details     = new Details();

            $details->setTax(0)->setSubtotal($payment->transactions[0]->amount->total);

            $amount->setCurrency('USD')->setTotal($payment->transactions[0]->amount->total)->setDetails($details);

            $transaction->setAmount($amount);

            $execution->addTransaction($transaction);

            try {

//                $result = $payment->execute($execution, $this->apiContext);

                try {

                    $payment = Payment::get($request->paymentId, $this->apiContext);

                    $in = new Payments();
                    $in->type = 'visa';
                    $in->user_id =$request->user_id;

                    $in->save();

                    Paypal::create([
                        'user_id' => $request->user_id,
                        'payment_id' => $payment->id,
                        'inner_payment_id' => $in->id,
                        'status' => $payment->state,
                        'payer_first_name' => $payment->payer->payer_info->first_name,
                        'payer_last_name' => $payment->payer->payer_info->last_name,
                        'payer_email'   => $payment->payer->payer_info->email,
                        'payer_id'  => $payment->payer->payer_info->payer_id,
                        'payer_phone' => $payment->payer->payer_info->phone,
                        'amount' => $payment->transactions[0]->amount->total,
//                        'payment_method' => $payment->payer->payment_method,

                    ]);

                    $user=User::findorFail($request->user_id);
                    $user->commission=0;
                    $user->save();
//                    $transaction = new \App\Models\Transaction();
//                    $transaction->type = 'deposit';
//                    $transaction->amount = $payment->transactions[0]->amount->total;
//                    $transaction->payment_id = $in->id;
//                    $transaction->reason = "paypal";
//                    $transaction->save();

//                    $user=User::find(auth()->id());
//                    $user->balance=$user->balance+$payment->transactions[0]->amount->total;
//
//                    $user->save();

                } catch (\Exception $e)
                {
                    alert()->error('حد2ث خطأ ');
                    return redirect('/');
                }

            } catch (\Exception $e) {

                alert()->error('حدث خطأ ');
                return redirect('/');
            }
            $added=$payment->transactions[0]->amount->total;
            alert()->success(" تم بنجاح ترقية عضويتك");
            return redirect('/');


        }
        else
        {
            alert()->warning("خطأ");
            return redirect()->back();

        }
    }

    /**
     * Cancel The Payment
     * @param Request $request
     * @return array
     */
    public function onProcessingTripCanceled(Request $request)
    {
        $data = [
            'data' => [
                'status' => 0,
                'msg' => 'حدث خطأ',
            ]
        ];

        return Response::json($data, 200);
    }

}
