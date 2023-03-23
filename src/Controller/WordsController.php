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
        $allEnglishWords = file('https://raw.githubusercontent.com/dwyl/english-words/master/words_alpha.txt');
        $requestBody = json_decode($request->getContent(), true);
        $word = trim(strtolower($requestBody['word']));

        if (!in_array(strtolower($word), array_map('trim', $allEnglishWords))) {
            return new JsonResponse([
                'error' => 'Word not found in dictionary'
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $points = $gameplayService->play($word);
        return new JsonResponse(['Points earned: ' => $points]);
    }
}
