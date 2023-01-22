<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Http\Requests;

trait HasArticlePrepareForValidation
{
    public function prepareForValidation(): void
    {
        if ($this->has('status_id')) {
            $this->merge(['status_id' => $this->integer('status_id', null)]);
        }

        if ($this->has('published_at')) {
            $this->merge(['published_at' => $this->date('published_at')]);
        }

        if ($this->has('expires_at')) {
            $this->merge(['expires_at' => $this->date('expires_at')]);
        }
    }
}
