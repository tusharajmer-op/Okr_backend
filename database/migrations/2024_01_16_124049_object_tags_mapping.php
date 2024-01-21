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
        Schema::create("object_tags_mapping", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("object_id");
            $table->unsignedBigInteger("tag_id");
            $table->foreign("object_id")->references("id")->on("objects")->onDelete("cascade");
            $table->foreign("tag_id")->references("id")->on("tags")->onDelete("cascade");
            $table->unique(["object_id","tag_id"]);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists("object_tags_mapping");
    }
};
