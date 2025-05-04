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
        Schema::create('course_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained();
            $table->foreignId('subject_id')->constrained();
            $table->foreignId('teacher_id')->constrained('users');
            $table->year('school_year');
            $table->timestamps();
            $table->unique(['class_id','subject_id','school_year']);
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_assignments');
    }
};
