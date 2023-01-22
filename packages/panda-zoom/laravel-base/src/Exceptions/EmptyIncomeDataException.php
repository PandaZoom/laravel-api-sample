<?php

namespace PandaZoom\LaravelBase\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class EmptyIncomeDataException extends HttpException
{
    public function __construct(string $message = '', Throwable $previous = null, array $headers = [])
    {
        parent::__construct(
            Response::HTTP_BAD_REQUEST,
            $message !== '' ?: 'Bad Request. Empty request data.',
            $previous,
            $headers
        );
    }
}
