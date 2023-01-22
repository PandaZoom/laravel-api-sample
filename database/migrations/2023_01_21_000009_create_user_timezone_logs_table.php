<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_timezone_logs', static function (Blueprint $table): void {
            $table->unsignedBigInteger('user_id')->index();
            $table->string('timezone', 50)->index();
            $table->unsignedBigInteger('editor_id')->index();
            $table->timestampTz('created_at')->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_timezone_logs');
    }
};
