<?php

namespace App\Controller;

use App\Service\CheckProService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/check-pro')]
final class CheckOutProController extends AbstractController
{
    private $checkPro;

    public function __construct(CheckProService $checkProService)
    {
        $this->checkPro = $checkProService;
    }

    #[Route('/', methods: ['POST'])]
    public function index(Request $request): JsonResponse
    {
        $data = ($request->headers->get('Content-Type') == 'application/json') ? $request->toArray() : $request->request->all();

        $pagamento = $this->checkPro->gerarPagamento($data);

        return $this->json($pagamento, $pagamento['status']);
    }
}
