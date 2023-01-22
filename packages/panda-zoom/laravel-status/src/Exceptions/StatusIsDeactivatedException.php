<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use function trans;

class StatusIsDeactivatedException extends HttpException
{
    public function __construct($message = '', Throwable $previous = null, array $headers = [])
    {
        parent::__construct(
            Response::HTTP_FORBIDDEN,
            $message !== '' ?: trans('user::users.common.messages.error_403_user_deactivated'),
            $previous,
            $headers
        );
    }
}
