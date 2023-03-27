<?php

namespace App\Model;

use Symfony\Component\HttpKernel\Exception\HttpException;

class ClientError extends HttpException
{
    public function __construct(int $statusCode, string $message = '', \Throwable $previous = null, array $headers = [], int $code = 0)
    {
        parent::__construct($statusCode, $message, $previous, $headers, $code);
    }

    public static function badRequest(int $statusCode = 400, string $message = 'Bad request'): self
    {
        return new self($statusCode, $message);
    }
}