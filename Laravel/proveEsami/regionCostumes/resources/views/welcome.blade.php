<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Laravel TSDWL Project</title>
    </head>
    <body>
            <h1>Benvenuto!</h1>
            <br><br>
            <h3>Regions Actions</h3><br>
            <form method="get" action="/regions">
                <button type="submit">List Regions</button>
            </form><br>
            <form method="get" action="/regions/create">
                <button type="submit">Create Region</button>
            </form><br><br><br>
            <h3>Costumes Actions</h3><br>
            <form method="get" action="/costumes">
                <button type="submit">List Costumes</button>
            </form><br>
            <form method="get" action="/costumes/create">
                <button type="submit">Create Costume</button>
            </form><br>
            <form method="post" action="/costumes/dimezza">
                @csrf
                <button type="submit">Arriva Arlecchino</button>
            </form><br>
    </body>
</html>
