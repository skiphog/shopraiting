<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('brands',static function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('img')->nullable();
            $table->string('link');
            $table->string('pixel')->nullable();

            // SEO
            $table->string('seo_h1');
            $table->string('seo_title');
            $table->string('seo_description');

            $table->text('description');
            $table->text('content');
            $table->string('country');

            $table->unsignedFloat('rating', 4)->default(0.00);
            $table->unsignedFloat('hack_rating', 4)->default(0.00);
            $table->unsignedInteger('position')->default(1);

            $table->timestamps();
            $table->boolean('activity')->default(true);

            // Indexes
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
        Schema::dropIfExists('brands');
    }
};
