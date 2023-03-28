<?php

namespace App\Controller;

use App\Model\Dictionary\Exception\NotEnglishWordException;
use App\Model\Word\Exception\NotAWord;
use App\Model\Word\Exception\NotAWordException;
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

        if (!array_key_exists('word', $requestBody)) {
            return new JsonResponse(['message' => 'Bad request'], 400);
        }

        try {
            $points = $gameplayService->play($requestBody['word']);
            return new JsonResponse($points);
        } catch (NotEnglishWordException | NotAWordException $e) {
            return new JsonResponse(['message' => $e->getMessage()], 400);
        }
    }
}
