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
        //
        Schema::create('keys', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description', 1000);
            $table->integer('cascade_approach_id')->references('id')->on('cascade_approaches')->onDelete('cascade');
            
            $table->integer('keytype_id')->references('id')->on('keysubtypes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('keys');
        
    }
};
