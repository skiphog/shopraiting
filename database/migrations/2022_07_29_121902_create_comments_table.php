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
        Schema::create('comments', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->string('post_type', 50);

            $table->string('name');
            $table->string('email');
            $table->enum('avatar_color', ['ava-blue', 'ava-red']);

            $table->text('message');
            $table->text('answer')->nullable();

            $table->timestamp('answered_at')->nullable();
            $table->timestamps();
            $table->boolean('activity')->default(false);

            $table->index(['post_id', 'post_type']);
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
        Schema::dropIfExists('comments');
    }
};
