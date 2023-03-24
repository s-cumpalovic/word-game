<?php

namespace App\Controller;

use App\Service\GameplayService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WordsController extends AbstractController
{
    #[Route('/play', methods: ['POST'])]
    public function store(GameplayService $gameplayService, Request $request): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);
        $word = trim(strtolower($requestBody['word']));

        $points = $gameplayService->play($word);
        if ($points === -1) {
            return new JsonResponse(['Word is not an english word']);
        }
        return $points;
    }
}
