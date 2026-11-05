<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Location;
use App\Models\Quest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class QuestController extends Controller
{
    public function index(Request $request)
    {
        $quests = Quest::query()
            ->with('category')
            ->when(
                $request->query('search'),
                fn ($query, $search) => $query->where('title', 'like', "%{$search}%")
            )
            ->when(
                $request->query('category'),
                fn ($query, $categoryId) => $query->where('category_id', $categoryId)
            )
            ->orderByDesc('xp')
            ->paginate(10)
            ->withQueryString();

        return view('quests.index', [
            'quests' => $quests,
            'categories' => Category::all(),
        ]);
    }

    public function show(int $id)
    {
        return view('quests.show', [
            'quest' => Quest::with(['category', 'locations'])->findOrFail($id),
        ]);
    }

    public function create()
    {
        return view('quests.create', [
            'categories' => Category::all(),
            'locations' => Location::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'xp' => ['required', 'integer', 'min:0', 'max:500'],
            'difficulty' => ['required', Rule::in(['easy', 'medium', 'hard'])],
            'category_id' => ['required', 'exists:categories,id'],
            'featured' => ['boolean'],
            'location_ids' => ['array'],
            'location_ids.*' => ['exists:locations,id'],
        ]);

        $quest = Quest::create(Arr::except($validated, 'location_ids'));
        $quest->locations()->sync($validated['location_ids'] ?? []);

        return redirect()->route('quests.show', $quest->id)->with('success', 'Quête créée !');
    }

    public function edit(int $id)
    {
        return view('quests.edit', [
            'quest' => Quest::findOrFail($id),
            'categories' => Category::all(),
            'locations' => Location::all(),
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
            'featured' => ['boolean'],
            'location_ids' => ['array'],
            'location_ids.*' => ['exists:locations,id'],
        ]);

        $quest->update(Arr::except($validated, 'location_ids'));
        $quest->locations()->sync($validated['location_ids'] ?? []);

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
