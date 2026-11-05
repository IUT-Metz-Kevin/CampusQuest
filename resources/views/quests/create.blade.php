@extends('layouts.app')

@section('title', 'Nouvelle quête')

@section('styles')
    @vite('resources/css/forms.css')
@endsection

@section('content')
    <h1>Nouvelle quête</h1>

    <form method="POST" action="{{ route('quests.store') }}">
        @csrf

        <label for="title">Titre</label>
        <input id="title" name="title" type="text">

        <label for="description">Description</label>
        <textarea id="description" name="description"></textarea>

        <label for="xp">XP</label>
        <input id="xp" name="xp" type="number">

        <label for="difficulty">Difficulté</label>
        <select id="difficulty" name="difficulty">
            <option value="easy">Facile</option>
            <option value="medium">Moyenne</option>
            <option value="hard">Difficile</option>
        </select>

        <label for="category_id">Catégorie</label>
        <select id="category_id" name="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <button type="submit">Créer la quête</button>
    </form>
@endsection
