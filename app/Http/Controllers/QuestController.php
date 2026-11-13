<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Quest;
use Illuminate\Http\Request;

class QuestController extends Controller
{
    public function index(Request $request)
    {
        $quests = Quest::query()
            ->when(
                $request->query('search'),
                fn ($query, $search) => $query->where('title', 'like', "%{$search}%")
            )
            ->when(
                $request->query('category'),
                fn ($query, $categoryId) => $query->where('category_id', $categoryId)
            )
            ->orderByDesc('xp')
            ->get();

        return view('quests.index', [
            'quests' => $quests,
            'categories' => Category::all(),
        ]);
    }

    public function show(int $id)
    {
        return view('quests.show', ['quest' => Quest::findOrFail($id)]);
    }
}
