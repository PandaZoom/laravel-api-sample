<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('language_active_logs', static function (Blueprint $table): void {
            $table->unsignedInteger('lang_id')->index();
            $table->boolean('active')->unsigned()->default(false)->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->timestampTz('created_at')->nullable();

            $table->foreign('lang_id')
                ->references('id')
                ->on('languages')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('language_active_logs');
    }
};
