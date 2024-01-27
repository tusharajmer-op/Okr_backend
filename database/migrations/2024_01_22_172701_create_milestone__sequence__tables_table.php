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
        Schema::create('milestone__sequence__tables', function (Blueprint $table) {
            $table->id();
            $table->string('sequence')->unique();
            $table->date('start');
            $table->date('end');
            $table->integer('increment');
            $table->integer('milestone_sequence_template_id')->references('id')->on('milestone__sequence__templates')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milestone__sequence__tables');
    }
};
