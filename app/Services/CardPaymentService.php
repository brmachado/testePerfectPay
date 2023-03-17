<?php

namespace App\Services;

class CardPaymentService
{
    /** @var string  */
    private $accessToken;

    public function __construct()
    {
        $this->accessToken = env('MP_TOKEN');
        \MercadoPago\SDK::setAccessToken($this->accessToken);
    }

    /**
     * @param $data
     * @return array
     * @throws \Exception
     */
    public function service($data)
    {
        $payment = new \MercadoPago\Payment();

        $payment->transaction_amount = $data['transactionAmount'];
        $payment->token = $data['token'];
        $payment->description = $data['description'];
        $payment->installments = $data['installments'];
        $payment->payment_method_id = $data['paymentMethodId'];
        $payment->issuer_id = $data['issuerId'];

        $payer = new \MercadoPago\Payer();
        $payer->email = $data['payer']['email'];
        $payer->identification = array(
            "type" => $data['payer']['identification']['type'],
            "number" => $data['payer']['identification']['number']
        );

        $payment->payer = $payer;

        $payment->save();

        if($payment->id === null) {
            $errorMessage = 'Erro na transação';

            if ($payment->error !== null && $payment->error->message !== null) {
                $errorMessage = $payment->error->message;
            }

            throw new \Exception($errorMessage);
        }

        $response = [
            'status' => $payment->status,
            'status_detail' => $payment->status_detail,
            'id' => $payment->id
        ];
        return $response;
    }
}
