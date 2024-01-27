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
        Schema::table('keys', function (Blueprint $table) {
            $table->dropColumn('keytype_id');
            $table->foreignId('keysubtype_id')->constrained('keysubtypes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('keys', function (Blueprint $table) {
            $table->dropForeign('keys_keysubtype_id_foreign');
            $table->dropColumn('keysubtype_id');
            $table->integer('keytype_id')->unsigned();
        });
    }
};
