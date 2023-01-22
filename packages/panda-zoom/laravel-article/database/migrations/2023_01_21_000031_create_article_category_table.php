<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('article_category', static function (Blueprint $table): void {

            $table->unsignedBigInteger('article_id')->index();
            $table->unsignedBigInteger('category_id')->index();

            $table->primary(['article_id', 'category_id']);

            $table->foreign('article_id')
                ->references('id')
                ->on('articles')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_category');
    }
};
