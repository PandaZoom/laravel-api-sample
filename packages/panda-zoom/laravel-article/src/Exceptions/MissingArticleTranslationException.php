<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use function trans;

class MissingArticleTranslationException extends HttpException
{
    public function __construct($message = '', Throwable $previous = null, array $headers = [])
    {
        parent::__construct(
            Response::HTTP_BAD_REQUEST,
            $message !== '' ?: trans('article::articles.common.messages.error_400_missing_translations'),
            $previous,
            $headers
        );
    }
}
