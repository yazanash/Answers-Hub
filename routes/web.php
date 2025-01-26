<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/categories', App\Http\Controllers\CategoryController::class);
Route::resource('/groups', App\Http\Controllers\GroupController::class);


Route::resource('/posts', App\Http\Controllers\PostController::class)->middleware('auth');
Route::resource('/questions', App\Http\Controllers\QuestionController::class)->middleware('auth');
Route::post('/posts/{post}/commments', [App\Http\Controllers\CommentController::class, 'store'])
->name('comment.store')->middleware('auth');
Route::post('/question/{question}/answer', [App\Http\Controllers\AnswerController::class, 'store'])
->name('answer.store')->middleware('auth');
Route::resource('/profile', App\Http\Controllers\ProfileController::class)->middleware('auth');