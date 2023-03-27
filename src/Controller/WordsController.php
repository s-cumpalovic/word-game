<?php

namespace App\Controller;

use App\Model\BadRequestBodyException;
use App\Model\ClientError;
use App\Model\NotEnglishWordException;
use App\Service\GameplayService;
use http\Client;
use PHPUnit\Util\Json;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WordsController extends AbstractController
{
    #[Route('/play', methods: ['POST'])]
    public function store(GameplayService $gameplayService, Request $request): JsonResponse
    {
        try {
            $requestBody = json_decode($request->getContent(), true);
            if (!array_key_exists('word', $requestBody)) {
                throw new BadRequestBodyException();
            }

            $word = trim(strtolower($requestBody['word']));
            $points = $gameplayService->play($word);

            return new JsonResponse($points);
        } catch (NotEnglishWordException|BadRequestBodyException $e) {
            return new JsonResponse(['message' => $e->getMessage()], 400);
        }
    }
}
