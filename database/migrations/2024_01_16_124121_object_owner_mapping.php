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
        Schema::create("object_owner_mapping", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("object_id");
            $table->unsignedBigInteger("owner_id");
            $table->foreign("object_id")->references("id")->on("objects")->onDelete("cascade");
            $table->foreign("owner_id")->references("id")->on("users")->onDelete("cascade");
            $table->unique(["object_id","owner_id"]);
    });}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists("object_owner_mapping");
    }
};
