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
        Schema::create("object_department_mapping", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("object_id");
            $table->unsignedBigInteger("department_id");
            $table->foreign("object_id")->references("id")->on("objects")->onDelete("cascade");
            $table->foreign("department_id")->references("id")->on("departments")->onDelete("cascade");
            $table->unique(["object_id","department_id"]);
    });}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists("object_department_mapping");
    }
};
