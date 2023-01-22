<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Http\Requests;

class CategoryUpdateRequest extends CategoryStoreRequest
{
    use HasCategoryUpdatePrepare;
}
