<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PandaZoom\LaravelArticle\Enums\ArticleStatus;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comment_message_logs', static function (Blueprint $table): void {
            $table->unsignedBigInteger('comment_id')->index();
            $table->text('message');
            $table->unsignedBigInteger('user_id')->index();
            $table->timestampTz('created_at')->nullable();

            $table->foreign('comment_id')
                ->references('id')
                ->on('comments')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comment_message_logs');
    }
};
