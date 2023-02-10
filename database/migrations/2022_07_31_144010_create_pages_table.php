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
        Schema::create('pages', static function (Blueprint $table) {
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

        Schema::create('page_shop', static function (Blueprint $table) {
            $table->unsignedBigInteger('page_id');
            $table->unsignedBigInteger('shop_id');

            $table->primary(['page_id', 'shop_id']);

            $table->foreign('page_id')
                ->references('id')
                ->on('pages');

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
        Schema::dropIfExists('pages');
        Schema::dropIfExists('page_shop');
    }
};
