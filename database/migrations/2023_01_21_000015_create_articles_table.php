<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('articles', static function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedTinyInteger('status_id')->index();
            $table->unsignedBigInteger('views')->default(0)->index();
            $table->timestampTz('published_at')->nullable();
            $table->timestampTz('expires_at')->nullable();
            $table->timestampsTz();
            $table->softDeletesTz();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreign('status_id')
                ->references('id')
                ->on('statuses')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });

        Schema::create('article_translations', static function (Blueprint $table): void {
            $table->unsignedBigInteger('article_id')->index();
            $table->string('locale', 6)->index();
            $table->string('title'); // for meta tag `title`
            $table->string('description')->nullable(); // for meta tag `description`
            $table->string('name');
            $table->text('summary')->nullable();
            $table->text('story')->nullable();

            $table->primary(['article_id', 'locale']);

            $table->foreign('article_id')
                ->references('id')
                ->on('articles')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_translations');
        Schema::dropIfExists('articles');
    }
};
