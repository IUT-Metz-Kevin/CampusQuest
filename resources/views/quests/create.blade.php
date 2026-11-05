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
        <input id="title" name="title" type="text" value="{{ old('title') }}">
        @error('title')
            <p class="error">{{ $message }}</p>
        @enderror

        <label for="description">Description</label>
        <textarea id="description" name="description">{{ old('description') }}</textarea>
        @error('description')
            <p class="error">{{ $message }}</p>
        @enderror

        <label for="xp">XP</label>
        <input id="xp" name="xp" type="number" value="{{ old('xp') }}">
        @error('xp')
            <p class="error">{{ $message }}</p>
        @enderror

        <label for="difficulty">Difficulté</label>
        <select id="difficulty" name="difficulty">
            <option value="easy" @selected(old('difficulty') === 'easy')>Facile</option>
            <option value="medium" @selected(old('difficulty') === 'medium')>Moyenne</option>
            <option value="hard" @selected(old('difficulty') === 'hard')>Difficile</option>
        </select>
        @error('difficulty')
            <p class="error">{{ $message }}</p>
        @enderror

        <label for="category_id">Catégorie</label>
        <select id="category_id" name="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected((int) old('category_id') === $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
            <p class="error">{{ $message }}</p>
        @enderror

        <button type="submit">Créer la quête</button>
    </form>
@endsection
