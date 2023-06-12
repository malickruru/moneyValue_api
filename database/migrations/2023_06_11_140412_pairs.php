<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pairs', function (Blueprint $table) {
            $table->id();
            $table->string('from');
            $table->string('to');
            $table->foreign('from')
                ->references('code')
                ->on('currencies')
                ->onDelete('cascade');
            $table->foreign('to')
                ->references('code')
                ->on('currencies')
                ->onDelete('cascade');
            $table->double('change_rate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pairs');
    }
};
