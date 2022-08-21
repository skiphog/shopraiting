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
        Schema::create('shops', static function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('img')->nullable();
            $table->string('link');
            $table->string('pixel');

            $table->string('seo_h1');
            $table->string('seo_title');
            $table->string('seo_description');

            $table->string('seo_h1_reviews');
            $table->string('seo_title_reviews');
            $table->string('seo_description_reviews');

            $table->string('advantage')->default('');
            $table->string('description', 500)->default('');
            $table->json('contents');
            $table->text('content');

            $table->unsignedFloat('rating', 4)->default(0.00);
            $table->unsignedFloat('hack_rating', 4)->default(0.00);
            $table->unsignedInteger('position')->default(1);

            $table->unsignedInteger('cities_cnt')->nullable();
            $table->unsignedInteger('brands_cnt')->nullable();
            $table->unsignedInteger('products_cnt')->nullable();
            $table->string('delivery_cost')->nullable();
            $table->string('delivery_time')->nullable();
            $table->string('discounts')->nullable();
            $table->year('founding_year')->nullable();

            $table->timestamps();
            $table->boolean('activity')->default(true);

            //Indexes
            $table->unique('slug');
            $table->index('position');
            $table->index('activity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
