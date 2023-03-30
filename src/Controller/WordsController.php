<?php

namespace App\Controller;

use App\Model\Dictionary\Exception\NotEnglishWordException;
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
        /**
         * @var string $content
         */
        $content = $request->getContent();

        /**
         * @var array $requestBody
         */
        $requestBody = json_decode($content, true);

        if (!array_key_exists('word', $requestBody)) {
            return new JsonResponse(['message' => 'Bad request'], 400);
        }
        /**
         * @var string $word
         */
        $word = $requestBody['word'];
        try {
            $points = $gameplayService->play($word);

            return new JsonResponse($points);
        } catch (NotEnglishWordException|NotAWordException $e) {
            return new JsonResponse(['message' => $e->getMessage()], 400);
        }
    }
}
