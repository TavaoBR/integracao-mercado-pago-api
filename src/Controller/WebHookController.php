<?php

namespace App\Controller;

use App\Service\BuscarPagamentoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/web-hook')]
final class WebHookController extends AbstractController
{
    private $buscarPagamento;

    public function __construct(BuscarPagamentoService $buscarPagamentoService)
    {
        $this->buscarPagamento = $buscarPagamentoService;
    }

    #[Route('/mercado-pago', methods: ['POST'])]
    public function index(Request $request): JsonResponse
    {
        $data = ($request->headers->get('Content-Type') == 'application/json') ? $request->toArray() : $request->request->all();

        $idPagamento = $data['data']['id'];

        $buscar = $this->buscarPagamento->buscarIdPagamento($idPagamento);

        return $this->json($buscar, $buscar['status']);
    }
}
