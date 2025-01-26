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


Route::get('/profile/{slug}', [App\Http\Controllers\ProfileController::class, 'public_show'])->name('profiles.show.slug');
Route::get('/posts/{slug}', [App\Http\Controllers\PostController::class, 'public_show'])->name('posts.show.slug');
Route::get('/groups/{slug}', [App\Http\Controllers\GroupController::class, 'public_show'])->name('groups.show.slug');
Route::get('/questions/{slug}', [App\Http\Controllers\QuestionController::class, 'public_show'])->name('question.show.slug');
Route::get('/categories/{slug}', [App\Http\Controllers\CategoryController::class, 'public_show'])->name('categories.show.slug');