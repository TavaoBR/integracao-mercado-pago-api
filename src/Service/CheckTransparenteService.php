<?php

namespace App\Service;

use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\MercadoPagoConfig;

class CheckTransparenteService
{
    public function pix(array $data)
    {
        MercadoPagoConfig::setAccessToken($_ENV['MERCADO_PAGO_TOKEN_TRANSPARENTE']);
        $client = new PaymentClient();

        try {
            $payment = $client->create([
                "transaction_amount" => $data['amount'],
                "description" => $data['description_product'],
                "payment_method_id" => "pix",
                "payer" => [
                    "first_name" => $data['fisrt_name'],
                    "last_name" => $data['last_name'],
                    "email" => $data['email'],
                    "identification" => [
                        "type" => "CPF",
                        "number" => $data['cpf']
                    ]
                ],

                "additiona_info" => [
                    "items" => [[
                        "id" => $data['id_product'],
                        "title" => $data['name_product'],
                        "quantity" => 1,
                        "unit_price" => $data['amount'],
                        "category_id" => "services"
                    ]]
                ],

                "external_reference" => $this->generateGUID()
            ]);

            $payload = $payment->point_of_interaction->transaction_data->qr_code;
            $qrcode = $payment->point_of_interaction->transaction_data->qr_code_base64;
            $external = $payment->external_reference;

            return [
                'status' => 201,
                'qrcode' => $qrcode,
                'payload' => $payload,
                'externalReference' => $external,
                'metadata' => $payment->metadata,
                'message' => 'Pagamento Pix Gerado com Sucesso'
            ];
        } catch (\Exception $e) {
            return [
                'status' => 500,
                'message' => 'Ocorreu algum erro inesperado',
                'errors' => $e->getMessage()
            ];
        }
    }
    public function cartao() {}


    function generateGUID()
    {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        return sprintf(
            '%04X%04X-%04X-%04X-%04X-%04X%04X%04X',
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(16384, 20479),
            mt_rand(32768, 49151),
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(0, 65535)
        );
    }
}
