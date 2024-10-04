<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NovelController;
Route::get('/', function () {
    return view('welcome');
});

Route::resource('novels', NovelController::class);


// Route::get('/', [NovelController::class, 'index'])->name('novel.index');
// Route::get('/novel',[NovelController::class, 'index'])->name('novel.index');
// Route::get('/novel/create',[NovelController::class, 'create'])->name('novel.create');
// Route::get('/novel/show/{novel}',[NovelController::class, 'show'])->name('novel.show');
// Route::post('/novel',[NovelController::class, 'store'])->name('novel.store');
// Route::get('/novel/edit/{novel}',[NovelController::class, 'edit'])->name('novel.edit');
// Route::put('/novel/update/{novel}',[NovelController::class, 'update'])->name('novel.update');
// Route::delete('/novel/destroy/{novel}',[NovelController::class, 'destroy'])->name('novel.destroy');