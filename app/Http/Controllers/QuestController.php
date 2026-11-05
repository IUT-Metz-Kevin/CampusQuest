<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Quest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'xp' => ['required', 'integer', 'min:0', 'max:500'],
            'difficulty' => ['required', Rule::in(['easy', 'medium', 'hard'])],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $quest = Quest::create($validated);

        return redirect()->route('quests.show', $quest->id)->with('success', 'Quête créée !');
    }

    public function edit(int $id)
    {
        return view('quests.edit', [
            'quest' => Quest::findOrFail($id),
            'categories' => Category::all(),
        ]);
    }

    public function update(Request $request, int $id)
    {
        $quest = Quest::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'xp' => ['required', 'integer', 'min:0', 'max:500'],
            'difficulty' => ['required', Rule::in(['easy', 'medium', 'hard'])],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $quest->update($validated);

        return redirect()->route('quests.show', $quest->id)->with('success', 'Quête mise à jour !');
    }

    public function destroy(int $id)
    {
        $quest = Quest::findOrFail($id);
        $quest->locations()->detach();
        $quest->delete();

        return redirect()->route('quests.index')->with('success', 'Quête supprimée !');
    }
}
