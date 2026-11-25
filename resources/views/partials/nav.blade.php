<nav class="nav">
    <a href="/">Campus Quest</a>
    <a href="{{ route('quests.index') }}">Quêtes</a>
    <a href="{{ route('leaderboard.index') }}">Classement</a>
    <a href="{{ route('quests.create') }}">Nouvelle quête</a>

    <span class="nav__user">
        @auth
            <span>{{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Déconnexion</button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}">Se connecter</a>
        @endguest
    </span>
</nav>
