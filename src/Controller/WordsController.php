<?php

namespace App\Controller;

use App\Exception\ClientError;
use App\Service\GameplayService;
use Exception;
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

            if(!array_key_exists('word', $requestBody)) {
                throw ClientError::badRequest();
            }

            $word = trim(strtolower($requestBody['word']));
            $points = $gameplayService->play($word);

            if ($points === 0) {
                throw ClientError::badRequest(400, 'Word is not an english word.');
            }

            return new JsonResponse($points);
        } catch (Exception $e) {
            throw ClientError::badRequest(400, $e->getMessage());
        }
    }
}
