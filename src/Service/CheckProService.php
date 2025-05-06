<?php

namespace App\Service;

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Preference\PreferenceClient;

class CheckProService
{

    public function gerarPagamento(array $data)
    {

        if (!isset($data['MERCADO_PAGO_TOKEN']) || $data['MERCADO_PAGO_TOKEN'] === null || $data['MERCADO_PAGO_TOKEN'] === "") {
            return [
                "status" => 400,
                "error" => "missing_token",
                "message" => "É necessário ter gerado um token válido e não vazio."
            ];
        }



        try {
            MercadoPagoConfig::setAccessToken($data['MERCADO_PAGO_TOKEN']);
            $client = new PreferenceClient();

            $preference = $client->create([
                "items" => [
                    [
                        "id" => $data['id_product'],
                        "title" => $data['name_product'],
                        "description" => $data['description_product'],
                        "quantity" => 1,
                        "currency_id" => "BRL",
                        "unit_price" => $data['amount']
                    ]
                ],
                "back_urls" => [
                    "success" => $data['url_success'],
                    "failure" => $data['url_failure'],
                    "pending" => $data['url_pending']
                ],
                "external_reference" => $this->generateGUID()
            ]);

            $external = $preference->external_reference;
            $init_point = $preference->init_point;

            return [
                'status' => 201,
                'message' => 'Pagamento Gerado com sucesso',
                'init_point' => $init_point,
                'externalReference' => $external,
                'metadata' => $preference,
            ];
        } catch (\Exception $e) {
            return [
                'status' => 500,
                'message' => 'Ocorreu algum erro inesperado',
                'errors' => $e->getMessage()
            ];
        }
    }

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
