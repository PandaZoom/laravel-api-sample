<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('categories', static function (Blueprint $table): void {
            $table->id();
            $table->boolean('active')->unsigned()->default(false)->index();
            $table->unsignedInteger('position')->default(0);
            $table->timestampsTz();
            $table->softDeletesTz();
        });

        Schema::create('category_translations', static function (Blueprint $table): void {

            $table->unsignedBigInteger('category_id')->index();
            $table->string('locale', 2)->index();
            $table->string('name');

            $table->primary(['category_id', 'locale']);

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('category_translations');
        Schema::dropIfExists('categories');
    }
};
