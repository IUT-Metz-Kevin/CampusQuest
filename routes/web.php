<?php

use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\QuestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('quests', QuestController::class)
    ->only(['index', 'show'])
    ->where(['quest' => '[0-9]+']);

Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::resource('quests', QuestController::class)
        ->except(['index', 'show'])
        ->where(['quest' => '[0-9]+']);
});

Route::get('/classement', [LeaderboardController::class, 'index'])
    ->name('leaderboard.index');

require __DIR__.'/auth.php';
