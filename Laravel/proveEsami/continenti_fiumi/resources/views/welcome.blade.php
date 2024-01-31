<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Laravel TSDWL Project</title>
    </head>
    <body>
            <h1>Benvenuto!</h1>
            <br><br>
            <h3>Continents Actions</h3><br>
            <form method="get" action="/continents">
                <button type="submit">List All Continent</button>
            </form><br>
            <form method="get" action="/continents/create">
                <button type="submit">Create Continent</button>
            </form><br>
            <form method="post" action="/continents/searchByName">
                @csrf
                <label>Search By Name:</label>
                <input type="text" name="nome" required>
                <button type="submit">Search</button>
            </form><br>
            <form method="post" action="/continents/deleteAll">
                @csrf
                <button type="submit">Delete All Continents</button>
            </form><br>
            <br><br>
            <h3>Fiumes Actions</h3><br>
            <form method="get" action="/fiumes">
                <button type="submit">List Fiumes</button>
            </form><br>
            <form method="get" action="/fiumes/create">
                <button type="submit">Create Fiume</button>
            </form><br>
            <form method="post" action="/fiumes/searchByName">
                @csrf
                <label>Search By Name:</label>
                <input type="text" name="nome" required>
                <button type="submit">Search</button>
            </form><br>
            <form method="post" action="/fiumes/deleteAll">
                @csrf
                <button type="submit">Delete All Fiumes</button>
            </form><br>
            <br><br>
    </body>
</html>
