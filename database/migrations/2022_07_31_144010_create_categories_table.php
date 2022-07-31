<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('categories', static function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->unsignedBigInteger('user_id');

            $table->string('name');
            $table->string('seo_h1');
            $table->string('seo_title');
            $table->string('seo_description');
            $table->text('before_content')->nullable();
            $table->text('content');

            $table->unique('slug');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });

        Schema::create('category_shop', static function (Blueprint $table) {
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('shop_id');

            $table->primary(['category_id', 'shop_id']);

            $table->foreign('category_id')
                ->references('id')
                ->on('categories');

            $table->foreign('shop_id')
                ->references('id')
                ->on('shops');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('category_shop');
    }
};
