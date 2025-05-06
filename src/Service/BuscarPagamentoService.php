<?php

namespace App\Service;

use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\MercadoPagoConfig;

class BuscarPagamentoService
{
    public function buscarIdPagamento($idPagamento)
    {

        $token = !empty($_ENV['MERCADO_PAGO_TOKEN_PRO'])
            ? $_ENV['MERCADO_PAGO_TOKEN_PRO']
            : $_ENV['MERCADO_PAGO_TOKEN_TRANSPARENTE'];

        MercadoPagoConfig::setAccessToken($_ENV['MERCADO_PAGO_TOKEN']);
        $client = new PaymentClient();
        $payment = $client->get($idPagamento);

        $payment = $client->get($idPagamento);
        if (!$payment) {
            return [
                "status" => 404,
                "message" => "Não Encontrado"
            ];
        }

        $status = $payment->status;
        $metodoPagamento = $payment->payment_method->id;

        return [
            'status' => 200,
            'statusPagamento' => $status,
            'metodoPagamento' => $metodoPagamento,
            'message' => 'Pagamento Encontrado',
            'metadata' => $payment
        ];
    }
}
