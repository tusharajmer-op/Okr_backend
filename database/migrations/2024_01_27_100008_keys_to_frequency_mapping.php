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
        Schema::create('key_frequency_mapping', function (Blueprint $table) {
            //
            $table->id();
            $table->integer('key_id')->references('id')->on('keys')->onDelete('cascade');
            $table->integer('frequency_id')->references('id')->on('check_in_frequencies')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('key_frequency_mapping', function (Blueprint $table) {
            //
        });
    }
};
