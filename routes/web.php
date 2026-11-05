<?php

use App\Http\Controllers\QuestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/quests', [QuestController::class, 'index'])->name('quests.index');
Route::get('/quests/create', [QuestController::class, 'create'])->name('quests.create');
Route::post('/quests', [QuestController::class, 'store'])->name('quests.store');
Route::get('/quests/{id}', [QuestController::class, 'show'])
    ->whereNumber('id')->name('quests.show');
Route::get('/quests/{id}/edit', [QuestController::class, 'edit'])->name('quests.edit');
Route::put('/quests/{id}', [QuestController::class, 'update'])->name('quests.update');
Route::delete('/quests/{id}', [QuestController::class, 'destroy'])->name('quests.destroy');
