<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use function trans;

class ArticleTranslationNotUpdatedException extends HttpException
{
    public function __construct($message = '', Throwable $previous = null, array $headers = [])
    {
        parent::__construct(
            Response::HTTP_INTERNAL_SERVER_ERROR,
            $message !== '' ?: trans('article::articles.common.messages.error_500_translation_not_updated'),
            $previous,
            $headers
        );
    }
}
