<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use function trans;

class StatusNotDeletedException extends HttpException
{
    public function __construct($message = '', Throwable $previous = null, array $headers = [])
    {
        parent::__construct(
            Response::HTTP_INTERNAL_SERVER_ERROR,
            $message !== '' ?: trans('article::articles.common.messages.error_500_not_deleted'),
            $previous,
            $headers
        );
    }
}
