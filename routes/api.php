<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum','verified'])->group(function () {
    Route::apiResource('enrollments', EnrollmentController::class);
    Route::apiResource('course-assignments', CourseAssignmentController::class);
    Route::apiResource('timetable', TimetableEntryController::class)
        ->except(['show']);
    Route::get('timetable/class/{class}', [TimetableEntryController::class,'byClass']);
    Route::get('timetable/teacher/{teacher}', [TimetableEntryController::class,'byTeacher']);
    Route::apiResource('enrollments', EnrollmentController::class)
      ->middleware(['auth:sanctum','verified','role:admin']);
      Route::apiResource('enrollments', EnrollmentController::class)
      ->middleware(['auth:sanctum','verified','role:admin']);


});


