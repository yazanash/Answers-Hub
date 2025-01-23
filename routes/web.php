<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/categories', App\Http\Controllers\CategoryController::class);
Route::resource('/groups', App\Http\Controllers\GroupController::class);

Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts');
Route::get('/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('posts.create');
Route::post('/posts/store', [App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
Route::get('/posts/edit/{$post}', [App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');
Route::post('/posts/update/{$post}', [App\Http\Controllers\PostController::class, 'update'])->name('posts.update');


Route::get('/questions', [App\Http\Controllers\QuestionController::class, 'index'])->name('questions');
Route::get('/questions/create', [App\Http\Controllers\QuestionController::class, 'create'])->name('questions.create');
Route::post('/questions/store', [App\Http\Controllers\QuestionController::class, 'store'])->name('questions.store');
Route::get('/questions/edit/{$question}', [App\Http\Controllers\QuestionController::class, 'edit'])->name('questions.edit');
Route::post('/questions/update/{$question}', [App\Http\Controllers\QuestionController::class, 'update'])->name('questions.update');

