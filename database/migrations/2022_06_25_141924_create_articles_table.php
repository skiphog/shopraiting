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
        Schema::create('articles',static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('slug');
            $table->string('img')->nullable();

            $table->string('intro', 500)->default('');
            $table->json('contents');
            $table->text('before_content');
            $table->text('content');

            $table->string('seo_h1');
            $table->string('seo_title');
            $table->string('seo_description');

            $table->unsignedInteger('view')->default(0);
            $table->unsignedSmallInteger('time_to_read')->default(0);

            $table->unsignedInteger('star_count')->default(0);
            $table->unsignedInteger('star_sum')->default(0);

            $table->timestamps();
            $table->boolean('activity')->default(true);

            //Indexes
            $table->unique('slug');
            $table->index('activity');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
