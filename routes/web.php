<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/quests', function () {
    return 'Liste des quêtes';
})->name('quests.index');

Route::get('/quests/{id}', function ($id) {
    return "Quête n°{$id}";
})->whereNumber('id')->name('quests.show');
