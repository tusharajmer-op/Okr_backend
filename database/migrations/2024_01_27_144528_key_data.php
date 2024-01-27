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
        Schema::create('key_values', function (Blueprint $table) {
            $table->id();
            $table->integer('value');
            $table->date('check_in_date')->default(today());
            $table->string('comment')->nullable();
            $table->foreignId('key_id')->constrained('keys')->onDelete('cascade');
            $table->foreignId('key_status_id')->constrained('keys_status')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('key_values');
    }
};
