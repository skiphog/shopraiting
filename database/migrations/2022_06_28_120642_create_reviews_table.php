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
        Schema::create('reviews', static function (Blueprint $table) {
            $table->id();

            // Morph relation
            $table->unsignedBigInteger('product_id');
            $table->string('product_type', 50);

            $table->unsignedFloat('rating', 4)->default(0.00);
			$table->unsignedInteger('likes')->default(0);
            $table->string('author_name');
            $table->string('author_email');
            $table->text('content');
            $table->timestamps();
            $table->boolean('activity')->default(false);

            //Indexes
            $table->index(['product_id', 'product_type']);
            $table->index('activity');
            $table->index('rating');
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
        Schema::dropIfExists('reviews');
    }
};
