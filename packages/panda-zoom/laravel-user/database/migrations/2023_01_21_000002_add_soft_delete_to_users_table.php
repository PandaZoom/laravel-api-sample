<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::whenTableDoesntHaveColumn('users', 'deleted_at', static function (Blueprint $table): void {
            $table->softDeletesTz()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::whenTableHasColumn('users', 'deleted_at', static function (Blueprint $table): void {
            $table->dropSoftDeletesTz();
        });
    }
};
