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
        Schema::whenTableDoesntHaveColumn('users', 'active', static function (Blueprint $table): void {
            $table->boolean('active')->unsigned()->default(true)->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::whenTableHasColumn('users', 'active', static function (Blueprint $table): void {
            $table->dropIndex(['active']);
            $table->dropColumn('active');
        });
    }
};
