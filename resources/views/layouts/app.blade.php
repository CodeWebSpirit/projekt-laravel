<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title','Quizy')</title>
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('home') }}">Home</a> |
            <a href="{{ route('quizzes.index') }}">Quizy</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>
