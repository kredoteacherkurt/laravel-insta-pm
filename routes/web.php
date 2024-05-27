<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;



Auth::routes();

Route::group(['middleware'=>'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::resource('/post',PostController::class);
    Route::resource('/comment',CommentController::class);

    Route::get('/profile/show/{id}',[ProfileController::class,'show'])->name('profile.show');
    Route::get('/profile/edit/',[ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile/update',[ProfileController::class,'update'])->name('profile.update');


});
