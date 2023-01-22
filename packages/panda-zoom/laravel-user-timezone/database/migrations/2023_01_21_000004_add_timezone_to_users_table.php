<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::whenTableDoesntHaveColumn('users', 'timezone', static function (Blueprint $table): void {
            $table->string('timezone', 50)->nullable();
        });
    }

    public function down(): void
    {
        Schema::whenTableHasColumn('users', 'timezone', static function (Blueprint $table): void {
            $table->dropColumn('timezone');
        });
    }
};
