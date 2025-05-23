<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\AcademicClassController;
use App\Http\Controllers\Api\Auth\RegisteredUserController;
use App\Http\Controllers\Api\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\ChapterController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\TopicController;

Route::post('student/register', [RegisteredUserController::class, 'store']);
Route::post('student/login', [AuthenticatedSessionController::class, 'store']);

Route::post('admin/register', [RegisteredUserController::class, 'store']);
Route::post('admin/login', [AuthenticatedSessionController::class, 'store']);

Route::post('data-entry/register', [RegisteredUserController::class, 'store']);
Route::post('data-entry/login', [AuthenticatedSessionController::class, 'store']);

Route::middleware('auth:api')->group(function () {
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy']);

    Route::apiResource('classes', AcademicClassController::class);
    Route::apiResource('departments', DepartmentController::class);
    Route::apiResource('subjects', SubjectController::class);
    Route::apiResource('chapters', ChapterController::class);
    Route::apiResource('topics', TopicController::class);
    Route::apiResource('questions', QuestionController::class);
});
