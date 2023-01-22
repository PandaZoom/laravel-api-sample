<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use function trans;

class UserNotRestoredException extends HttpException
{
    public function __construct($message = '', Throwable $previous = null, array $headers = [])
    {
        parent::__construct(
            Response::HTTP_INTERNAL_SERVER_ERROR,
            $message !== '' ?: trans('user::users.common.messages.error_500_user_not_restored'),
            $previous,
            $headers
        );
    }
}
