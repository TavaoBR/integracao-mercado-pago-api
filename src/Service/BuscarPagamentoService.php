<?php

namespace App\Service;

use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\MercadoPagoConfig;

class BuscarPagamentoService
{
    public function buscarIdPagamento($idPagamento)
    {
        MercadoPagoConfig::setAccessToken($_ENV['MERCADO_PAGO_TOKEN']);
        $client = new PaymentClient();
        $payment = $client->get($idPagamento);

        return [
            'status' => 200,
            'message' => 'Pagamento Encontrado',
            'metadata' => $payment
        ];
    }
}
