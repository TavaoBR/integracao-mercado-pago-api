<?php

namespace App\Controller;

use App\Service\CheckTransparenteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/check-transparente')]
final class CheckOutTransparenteController extends AbstractController
{
    private $ckeckTransparente;
    public function __construct(CheckTransparenteService $checkTransparenteService)
    {
        $this->ckeckTransparente = $checkTransparenteService;
    }

    #[Route('/pix', methods: ['POST'])]
    public function index(Request $request): JsonResponse
    {
        $data = ($request->headers->get('Content-Type') == 'application/json') ? $request->toArray() : $request->request->all();

        $gerarPix = $this->ckeckTransparente->pix($data);

        return $this->json($gerarPix, $gerarPix['status']);
    }
}
