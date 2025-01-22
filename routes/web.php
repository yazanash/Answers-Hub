<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/categories', App\Http\Controllers\CategoryController::class);

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

// Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
// Route::get('/categories/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
// Route::post('/categories/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
// Route::get('/categories/edit/{$category}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
// Route::post('/categories/update/{$category}', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
// Route::post('/categories/{$category}', [App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');
// Route::post('/categories/destroy/{$category}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('/groups', [App\Http\Controllers\GroupController::class, 'index'])->name('groups');
Route::get('/groups/create', [App\Http\Controllers\GroupController::class, 'create'])->name('groups.create');
Route::post('/groups/store', [App\Http\Controllers\GroupController::class, 'store'])->name('groups.store');
Route::get('/groups/edit/{$group}', [App\Http\Controllers\GroupController::class, 'edit'])->name('groups.edit');
Route::post('/groups/update/{$group}', [App\Http\Controllers\GroupController::class, 'update'])->name('groups.update');
