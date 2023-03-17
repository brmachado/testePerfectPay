<?php

namespace App\Services;

class TicketPaymentService
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
     * @return mixed
     * @throws \Exception
     */
    public function service($data)
    {
        $payment = new \MercadoPago\Payment();
        $payment->transaction_amount = $data['transactionAmount'];
        $payment->token = $this->accessToken;
        $payment->description = $data['description'];
        $payment->payment_method_id = $data['paymentMethodId'];
        $payment->payer = array(
            "email" => $data['email'],
            "first_name" => $data['name'],
            "last_name" => $data['lastname'],
            "identification" => array(
                "type" => $data['identificationType'],
                "number" => $data['identificationNumber']
            ),
            "address"=>  array(
                "zip_code" => $data['zipCode'],
                "street_name" => $data['streetName'],
                "street_number" => $data['streetNumber'],
                "neighborhood" => $data['neighborhood'],
                "city" => $data['city'],
                "federal_unit" => $data['federalUnit']
            )
        );

        $payment->save();

        if($payment->id === null) {
            $errorMessage = 'Erro na transação';

            if ($payment->error !== null && $payment->error->message !== null) {
                $errorMessage = $payment->error->message;
            }

            throw new \Exception($errorMessage);
        }

        return [
            'status' => true,
            'url' => $payment->transaction_details->external_resource_url
        ];
    }
}
