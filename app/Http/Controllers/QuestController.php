<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Quest;
use Illuminate\Http\Request;

class QuestController extends Controller
{
    public function index()
    {
        return view('quests.index', ['quests' => Quest::all()]);
    }

    public function show(int $id)
    {
        return view('quests.show', ['quest' => Quest::findOrFail($id)]);
    }

    public function create()
    {
        return view('quests.create', ['categories' => Category::all()]);
    }

    public function store(Request $request)
    {
        $data = $request->only(['title', 'description', 'xp', 'difficulty', 'category_id']);
        $quest = Quest::create($data);

        return redirect()->route('quests.show', $quest->id)->with('success', 'Quête créée !');
    }
}
