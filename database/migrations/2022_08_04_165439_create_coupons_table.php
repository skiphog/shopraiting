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
        Schema::create('coupons', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->enum('color', ['red', 'orange', 'green', 'blue']);
            $table->enum('type', ['promo', 'stock']);
            $table->string('type_content');
            $table->string('title');
            $table->text('content');
            $table->enum('button_type', ['coupon', 'link']);
            $table->string('button_content');
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            //$table->softDeletes();

            $table->foreign('shop_id')
                ->references('id')
                ->on('shops');

            $table->index(['start_at', 'end_at']);
            $table->index('end_at');
            //$table->index('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
