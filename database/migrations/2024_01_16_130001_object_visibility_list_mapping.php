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
        Schema::create("object_visibility_list_mapping", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("object_id");
            $table->unsignedBigInteger("user_id");
            $table->foreign("object_id")->references("id")->on("objects")->onDelete("cascade");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->unique(["object_id","user_id"]);
    });}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists("object_visibility_list_mapping");
    }
};
