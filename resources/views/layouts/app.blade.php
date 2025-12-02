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
h1, h2, h3 {
    font-weight: 700;
    margin-bottom: 15px;
    text-decoration: underline;
    color: #28a745;
    text-align: center;
}
header {
    background-color: #ff8800; 
    padding: 15px 0;
    margin-bottom: 30px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    text-align: center;
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

</style>
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('home') }}">Home</a> |
            <a href="{{ route('quizzes.index') }}">Quizy</a>
        </nav>
    </header>

    <main>
       <div class="container">
        @yield('content')
    </div>
    </main>
</body>
</html>
