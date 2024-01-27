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
        Schema::create('keys_to_objects', function (Blueprint $table) {
            //
            $table->id();
            $table->integer('key_id')->references('id')->on('keys')->onDelete('cascade');
            $table->integer('object_id')->references('id')->on('objects')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keys_to_objects');
    }
};
