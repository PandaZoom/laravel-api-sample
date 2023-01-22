<?php

namespace PandaZoom\LaravelComment\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use function trans;

class CommentNotUpdatedException extends HttpException
{
    public function __construct($message = '', Throwable $previous = null, array $headers = [])
    {
        parent::__construct(
            Response::HTTP_INTERNAL_SERVER_ERROR,
            $message !== '' ?: trans('comment::comments.common.messages.error_500_not_updated'),
            $previous,
            $headers
        );
    }
}
