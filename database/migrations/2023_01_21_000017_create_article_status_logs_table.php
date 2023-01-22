<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PandaZoom\LaravelArticle\Enums\ArticleStatus;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('article_status_logs', static function (Blueprint $table): void {
            $table->unsignedBigInteger('article_id')->index();
            $table->unsignedTinyInteger('status_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->timestampTz('created_at')->nullable();

            $table->foreign('article_id')
                ->references('id')
                ->on('articles')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_status_logs');
    }
};
