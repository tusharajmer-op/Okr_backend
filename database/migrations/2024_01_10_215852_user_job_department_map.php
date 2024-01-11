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
        Schema::create('user_job_department_map', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('job_id')->constrained('jobs', 'id')->cascadeOnDelete();
            $table->foreignId('department_id')->constrained('departments', 'id')->cascadeOnDelete();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->foreignId('manager_id')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('user_job_department_map');
    }
};
