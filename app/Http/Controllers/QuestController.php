<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Location;
use App\Models\Quest;
use Illuminate\Http\Request;

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
        $data = $request->only(['title', 'description', 'xp', 'difficulty', 'category_id', 'featured']);
        $quest = Quest::create($data);
        $quest->locations()->sync($request->input('location_ids', []));

        return redirect()->route('quests.show', $quest->id)->with('success', 'Quête créée !');
    }
}
