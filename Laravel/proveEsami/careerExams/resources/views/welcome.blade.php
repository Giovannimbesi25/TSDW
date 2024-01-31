<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Laravel TSWDL Project</title>
    </head>
    <body>
        <h2>Benvenuto!</h2><br>
        <h3>Careers Actions</h3>
        <form method="get" action="/careers">
            <button type="submit">List Careers</button>
        </form><br>
        <form method="get" action="/careers/create">
            <button type="submit">Create New Career</button>
        </form><br>
        <form method="post" action="/careers/deleteAll">
            @csrf
            <button type="submit">Delete All Continent</button>
        </form><br>
        <br>
        <h3>Exams Actions</h3>
        <form method="get" action="/exams">
            <button type="submit">List Exams</button>
        </form><br>
        <form method="get" action="/exams/create">
            <button type="submit">Create New Exam</button>
        </form><br>
        <form method="post" action="/exams/deleteAll">
            @csrf
            <button type="submit">Delete All Fiumes</button>
        </form><br>
        <br>
    </body>
</html>
