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
        Schema::create('banners', static function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('path');
            $table->string('link');
            $table->boolean('activity')->default(true);
            $table->unsignedTinyInteger('position')->default(10);

            $table->index('position');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
