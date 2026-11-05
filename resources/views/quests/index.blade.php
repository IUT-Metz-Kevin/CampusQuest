<h1>Quêtes disponibles</h1>
@forelse ($quests as $id => $quest)
    <a href="{{ route('quests.show', $id) }}">
        {{ $quest['title'] }} — {{ $quest['xp'] }} XP
    </a>
@empty
    <p>Aucune quête pour le moment.</p>
@endforelse
