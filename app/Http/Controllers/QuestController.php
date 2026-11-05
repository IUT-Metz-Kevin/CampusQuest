<?php

namespace App\Http\Controllers;

class QuestController extends Controller
{
    private array $quests = [
        1 => ['title' => 'Salle 404', 'xp' => 50, 'difficulty' => 'easy'],
        2 => ['title' => 'Quiz campus', 'xp' => 30, 'difficulty' => 'easy'],
        3 => ['title' => 'Selfie mascotte', 'xp' => 80, 'difficulty' => 'hard'],
    ];

    public function index()
    {
        return view('quests.index', ['quests' => $this->quests]);
    }

    public function show(int $id)
    {
        return view('quests.show', ['quest' => $this->quests[$id]]);
    }
}
