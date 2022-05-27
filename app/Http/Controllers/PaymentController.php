<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Transaction;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use Paypal\Exception\PayPalConnectionException;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DateInterval;
use DateTimeZone;
use DateTime;


class PaymentController extends Controller
{
    private  $apiContext;

    public function __construct()
    {
        $payPalConfig = Config::get(key: 'paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig['client_id'],
                $payPalConfig['secret']
            )
        );
    }

    public function payWithPayPal(Request $request)
    {
        // After Step 2
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        //Solo hay que cambiar esto, dependiendo el boton que se seleccione, el precio de la suscrpción cambiará
        $amount = new Amount();
        $amount->setTotal($request->input('precio'));
        $amount->setCurrency('EUR');

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription(description: 'Tu Plan ha sido activado');

        $callBackUrl = url(path: '/paypal/status');
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callBackUrl)
            ->setCancelUrl($callBackUrl);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);


        // After Step 3
        try {
            $payment->create($this->apiContext);
            //echo $payment;

            return redirect()->away($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {

            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            echo $ex->getData();
        }
    }

    public function paypalStatus(Request $request)
    {
        $paymentId = $request->input(key: 'paymentId');
        $payerId = $request->input(key: 'PayerID');
        $token = $request->input(key: 'token');
        if (!$paymentId || !$payerId || !$token) {
            $result = Null;
            $status = 'No se pudo procesar el pago a traves de PayPal';
            return redirect()->route('login')->with('status', $status);
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution(); //Contiene al payerId
        $execution->setPayerId($payerId);

        $result = $payment->execute($execution, $this->apiContext);
        $transaction = $payment->getTransactions()[0];
        $amount = $transaction->getAmount()->total;
        if ($result->getState() === 'approved') {
            $user = User::find(Auth::id());
            if ($user->type === 'Author') {
                switch ($amount) {
                    case 29.99:
                        $timeZone = new DateTimeZone('Europe/Madrid');
                        $dateNow = new DateTime();
                        $dateNow->setTimezone($timeZone);
                        $start = $dateNow->getTimestamp();
                        $dateNow->add(new DateInterval('P1M'));
                        $end = $dateNow->getTimestamp();
                        $user->numberDaysSuscripted += ($end - $start) / 86400;
                        $user->endSubscriptionDate = $dateNow->format('Y-m-d');
                        break;
                    case 74.99:
                        $timeZone = new DateTimeZone('Europe/Madrid');
                        $dateNow = new DateTime();
                        $dateNow->setTimezone($timeZone);
                        $start = $dateNow->getTimestamp();
                        $dateNow->add(new DateInterval('P3M'));
                        $end = $dateNow->getTimestamp();
                        $user->numberDaysSuscripted += ($end - $start) / 86400;
                        $user->endSubscriptionDate = $dateNow->format('Y-m-d');
                        break;
                    case 199.99:
                        $timeZone = new DateTimeZone('Europe/Madrid');
                        $dateNow = new DateTime();
                        $dateNow->setTimezone($timeZone);
                        $start = $dateNow->getTimestamp();
                        $dateNow->add(new DateInterval('P1Y'));
                        $end = $dateNow->getTimestamp();
                        $user->numberDaysSuscripted += ($end - $start) / 86400;
                        $user->endSubscriptionDate = $dateNow->format('Y-m-d');
                        break;
                }
            } else {
                switch ($amount) {
                    case 9.99:
                        $timeZone = new DateTimeZone('Europe/Madrid');
                        $dateNow = new DateTime();
                        $dateNow->setTimezone($timeZone);
                        $start = $dateNow->getTimestamp();
                        $dateNow->add(new DateInterval('P1M'));
                        $end = $dateNow->getTimestamp();
                        $user->numberDaysSuscripted += ($end - $start) / 86400;
                        $user->endSubscriptionDate = $dateNow->format('Y-m-d');
                        break;
                    case 24.99:
                        $timeZone = new DateTimeZone('Europe/Madrid');
                        $dateNow = new DateTime();
                        $dateNow->setTimezone($timeZone);
                        $start = $dateNow->getTimestamp();
                        $dateNow->add(new DateInterval('P3M'));
                        $end = $dateNow->getTimestamp();
                        $user->numberDaysSuscripted += ($end - $start) / 86400;
                        $user->endSubscriptionDate = $dateNow->format('Y-m-d');
                        break;
                    case 99.99:
                        $timeZone = new DateTimeZone('Europe/Madrid');
                        $dateNow = new DateTime();
                        $dateNow->setTimezone($timeZone);
                        $start = $dateNow->getTimestamp();
                        $dateNow->add(new DateInterval('P1Y'));
                        $end = $dateNow->getTimestamp();
                        $user->numberDaysSuscripted += ($end - $start) / 86400;
                        $user->endSubscriptionDate = $dateNow->format('Y-m-d');
                        break;
                }
            }

            $user->save();

            $status = 'Gracias! El pago a traves de PayPal se ha realizado correctamente.';
            return redirect()->route('home')->with('status', $status);
        }

        $status = 'Lo Sentimos! No se pudo realizar el pago a traves de PayPal';
        return redirect()->route('login')->with('status', $status);
    }
}
