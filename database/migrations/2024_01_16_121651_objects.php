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
        Schema::create("objects", function (Blueprint $table) {
            $table->id();
            $table->string("object_name");
            $table->enum("object_type",["department","user"]);
            $table->string("object_description");
            $table->string("object_status");
            $table->string("object_visibility");
            
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists("objects");
    }
};
