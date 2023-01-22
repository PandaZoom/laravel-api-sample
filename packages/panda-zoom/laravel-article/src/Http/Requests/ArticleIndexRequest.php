<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Http\Requests;

use Illuminate\Validation\Rule;
use PandaZoom\LaravelCategory\Models\Category;
use PandaZoom\LaravelPaginate\Requests\CursorBasedRequest;
use function trans;

class ArticleIndexRequest extends CursorBasedRequest
{
    use HasArticleRule;
    use HasArticlePrepareForValidation;

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            ...parent::rules(),
            'status_id' => [
                'sometimes',
                'integer'
            ],
            'category_id' => [
                'sometimes',
                'array',
            ],
            'category_id.*' => [
                'sometimes',
                'integer',
                Rule::exists(Category::class, 'id')->where('active', 1),
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'status_id' => trans('article::articles.common.attributes.status_id'),
            'category_id' => trans('article::articles.common.attributes.category_id'),
        ];
    }
}
