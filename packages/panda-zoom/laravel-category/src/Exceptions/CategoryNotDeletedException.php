<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use function trans;

class CategoryNotDeletedException extends HttpException
{
    public function __construct($message = '', Throwable $previous = null, array $headers = [])
    {
        parent::__construct(
            Response::HTTP_INTERNAL_SERVER_ERROR,
            $message !== '' ?: trans('category::categories.common.messages.error_500_category_not_deleted'),
            $previous,
            $headers
        );
    }
}
