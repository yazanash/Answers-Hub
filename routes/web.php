<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\MainController::class, 'index']); 
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');
Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/home', fn() => redirect('/home/article'))->name('home');
Route::get('/home/{type}/{slug?}', [App\Http\Controllers\HomeController::class, 'index'])->name('home.article')->middleware('verified');

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
Route::get('/question/{slug}', [App\Http\Controllers\QuestionController::class, 'public_show'])->name('question.show.slug');
Route::get('/category/{slug}', [App\Http\Controllers\CategoryController::class, 'public_show'])->name('category.show.slug');

Route::post('/answers/{answer}/helpful', [App\Http\Controllers\AnswerController::class, 'markAsHelpful'])->name('answer.helpful');
Route::post('/upload-image', [App\Http\Controllers\ImageUploadController::class, 'upload']);

Route::get('/admin/user-management', [App\Http\Controllers\AdminController::class, 'showUserManagement'])->name('admin.user-management');
Route::post('/admin/user-management', [App\Http\Controllers\AdminController::class, 'setUserRole'])->name('admin.set-user-role');
Route::post('/admin/user-management/update/{user}', [App\Http\Controllers\AdminController::class, 'updateUserRole'])->name('admin.update-user-role');
Route::middleware(['auth'])->group(function () {
    Route::post('/subscribe', [App\Http\Controllers\SubscriptionController::class, 'subscribe'])->name('subscribe');
    Route::post('/unsubscribe', [App\Http\Controllers\SubscriptionController::class, 'unsubscribe'])->name('unsubscribe');
});