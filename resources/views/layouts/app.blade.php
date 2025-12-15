<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quizy')</title>
    <style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f0f4f8;
    color: #333;
    margin: 0;
    padding: 0;
}
.container {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
}
h1, h2, h3, p {
    font-weight: 700;
    margin-bottom: 15px;
    text-decoration: underline;
    color: #28a745;
    text-align: center;
}
header {
    background-color: #ff8800;
    padding: 10px 0;
    margin-bottom: 30px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
.header-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: space-between; 
    align-items: center; 
}
nav a {
    color: white;
    font-weight: bold;
    margin: 0 5px;
}
.login-inline {
    display: flex;
    gap: 10px;
    align-items: center;
}
.login-inline label {
    display: none; 
}
.login-inline input {
    padding: 5px;
    border-radius: 4px;
    border: 1px solid #ccc;
    font-size: 14px;
    width: 140px; 
}
.btn-sm {
    padding: 5px 12px;
    font-size: 14px;
}
nav a {
    color: #fff !important;
}
a {
    text-decoration: none;
    color: #0077cc; 
    transition: color 0.2s ease-in-out;
}
a:hover {
    color: #e6244eff; 
}
button {
    background-color: #28a745; 
    color: #fff;
    border: none;
    padding: 10px 18px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.2s ease-in-out;
}
button:hover {
    background-color: #218838;
}
input[type="text"],
input[type="radio"],
input[type="checkbox"] {
    margin-right: 10px;
}
label {
    display: block;
    margin-bottom: 8px;
}
.quiz-question {
    background-color: #fff;
    border-left: 5px solid #ff8800;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}
.quiz-question p {
    margin: 0 0 10px 0;
}
.quiz-list li {
    background-color: #fff;
    border-left: 5px solid #0077cc;
    padding: 12px 15px;
    margin-bottom: 10px;
    border-radius: 5px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}
.quiz-list li a {
    font-weight: 600;
    color: #0077cc;
}
.quiz-result {
    background-color: #e6ffed;
    border: 2px solid #28a745;
    padding: 20px;
    border-radius: 8px;
    font-size: 18px;
    margin-top: 20px;
}
@media (max-width: 600px) {
    .container {
        padding: 10px;
    }

    button {
        width: 100%;
        padding: 12px 0;
    }
}
.float-right {
    float: right;
}

</style>
</head>
<body>
    <header>
    <div class="header-container">
        <nav>
            <a href="{{ route('home') }}">Home</a> |
            <a href="{{ route('quizzes.index') }}">Quizy</a>
            @if(Auth::check() && Auth::user()->is_admin)
                | <a href="{{ route('admin.quizzes.index') }}">Panel Admina</a>
            @endif
        </nav>
        @if($errors->any())
        <div style="color:red;>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
        @endif
        <div class="auth-bar">
            @if(Auth::check())
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <span>Witaj, {{ Auth::user()->name }}</span>
                    <button type="submit" class="btn-sm">Wyloguj</button>
                </form>
            @else
                <form method="POST" action="{{ route('login') }}" class="login-inline">
                    @csrf
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Hasło" required>
                    <button type="submit" class="btn-sm">Zaloguj</button>
                </form>
            @endif
        </div>
    </div>
</header>

    <main>
       <div class="container">
        @yield('content')
    </div>
    </main>
</body>
</html>
