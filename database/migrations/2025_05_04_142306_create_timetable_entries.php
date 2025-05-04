<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{public function down(): void
    {
        Schema::dropIfExists('timetable_entries');
    }
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('timetable_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained();
            $table->foreignId('subject_id')->constrained();
            $table->foreignId('teacher_id')->constrained('users');
            $table->string('room', 20);
            $table->unsignedTinyInteger('week_day');         // 0 = lundi
            $table->time('start_time');
            $table->time('end_time');
            $table->date('valid_from');
            $table->date('valid_to')->nullable();
            $table->timestamps();
            $table->unique(['class_id','week_day','start_time','valid_from'],'uniq_slot');
        });
    }

    /**
     * Reverse the migrations.
     */
    // Removed duplicate 'down' method to avoid redeclaration error
};
