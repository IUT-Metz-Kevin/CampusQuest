<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/quests', function () {
    $quests = [
        1 => ['title' => 'Salle 404', 'xp' => 50, 'difficulty' => 'easy'],
        2 => ['title' => 'Quiz campus', 'xp' => 30, 'difficulty' => 'easy'],
        3 => ['title' => 'Selfie mascotte', 'xp' => 80, 'difficulty' => 'hard'],
    ];
    return view('quests.index', ['quests' => $quests]);
})->name('quests.index');

Route::get('/quests/{id}', function ($id) {
    $quests = [
        1 => ['title' => 'Salle 404', 'xp' => 50, 'difficulty' => 'easy'],
        2 => ['title' => 'Quiz campus', 'xp' => 30, 'difficulty' => 'easy'],
        3 => ['title' => 'Selfie mascotte', 'xp' => 80, 'difficulty' => 'hard'],
    ];
    return view('quests.show', ['quest' => $quests[$id]]);
})->whereNumber('id')->name('quests.show');
