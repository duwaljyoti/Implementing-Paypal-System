<?php

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

class PaypalController extends BaseController
{
    private $_api_context;

    /**
     * @param ItemRepository $items
     * @param MyCartRepository $mycart
     */
    public function __construct(ItemRepository $items, MyCartRepository $mycart)
    {
        // setup PayPal api context
        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
        $this->item = $items;
        $this->mycart = $mycart;
    }

    public function pay()
    {
        // dd(Input::all());
        // echo "<pre>";
        // dd($this->_api_context);
        $transId = Input::get('id');
        Session::put('transactionID', $transId);
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $np = Input::get('price');
        $no = Input::get('quantity');
        var_dump($no);
        // foreach(Input::all() as $input){
        $item = new Item();
        $item->setName(Input::get('name'))

             ->setCurrency('EUR')
             ->setQuantity($np)
             ->setPrice($no);
        $items[] = $item;
        echo count($items);
        // }
        // dd($items);
        // dd($thi->_api_context);
        var_dump($items);
        $price = Input::get('price');
        $quan = Input::get('quantity');
        var_dump($price);
        var_dump($quan);

        $total = $price * $quan;
        var_dump($total);
        $item_list = new ItemList();
        $item_list->setItems($items);
        // dd($item_list);
        $amount = new Amount();
        $amount->setCurrency('EUR')
               ->setTotal($total);
        // var_dump($items);
        // var_dump($item_list);
        // dd($total);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
                    ->setItemList($item_list)
                    ->setDescription('jus a demo');

        $redirect_url = new RedirectUrls();
        $redirect_url->setReturnUrl(URL::route('paymentStatus'))
                     ->setCancelUrl(URL::route('paymentStatus'));
        $payment = new Payment();
        $payment->setIntent('sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_url)
                ->setTransactions(array($transaction));

// $payment->create($this->_api_context);
        //                 try {
        //     $response = $pp_payment->create();
        // } catch (PayPal\Exception\PPConnectionException $pce) {
        //     // Don't spit out errors or use "exit" like this in production code
        //     echo '<pre>';print_r(json_decode($pce->getData()));exit;
        // }
        // dd("runs up til here");\
        // dd($this->_api_context);
        try {
            $payment->create($this->_api_context);
            // $payment->create(c);
            // dd($payment);
            // dd("here");
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Some error occur, sorry for inconvenience');
            }

        } catch (Exception $ex) {
            dd($ex);
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        // add payment ID to session
        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {
            // redirect to paypal
            return Redirect::away($redirect_url);
        }

        return Redirect::route('original.route')
            ->with('error', 'Unknown error occurred');

    }

    /**
     * @param $value
     */
    public function paymentStatus($value = '')
    {
        // to get the payment id before the session id
        $payment_id = Session::get('paypal_payment_id');
        // clear the session payment Id
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerId')) || empty(Input::get('token'))) {
            return "Openation Failed";
        }

        $payment = Payment::get($payment_id, $this->_api_context);
        // PaymentExecution object includes information necessary
        // to execute a PayPal account payment.
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to your site
        $execution = new PaymentExecution();
        $execution = setPayeId(Input::get('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {
            $latestCart = MyCart::find(Session::get('transactionID'));
            // dd($latestCart);
            $latestCart->status = "Paid";
            $latestCart->save();
            return "Payment was Succesful..";
        } else {
            return "Operation Failed";
        }
    }

}
