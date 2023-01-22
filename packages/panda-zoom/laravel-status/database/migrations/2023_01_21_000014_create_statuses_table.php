<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PandaZoom\LaravelArticle\Enums\ArticleStatus;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('statuses', static function (Blueprint $table): void {
            $table->tinyIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->string('slug', 30)->unique();
            $table->timestampsTz();
            $table->softDeletesTz();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
