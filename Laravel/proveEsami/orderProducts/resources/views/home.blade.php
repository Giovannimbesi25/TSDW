<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>TSDWL Project</title>
    </head>
    <body>
        <h2>Benvenuto</h2><br><br>
        <h3>Orders Actions</h3><br>
        <form method="get" action="/orders">
            <button type="submit">List Orders</button>
        </form><br>
        <form method="get" action="/orders/create">
            <button type="submit">Create New Order</button>
        </form><br><br>
        <h3>Products Actions</h3><br>
        <form method="get" action="/products">
            <button type="submit">List Products</button>
        </form><br>
        <form method="get" action="/products/create">
            <button type="submit">Create New Product</button>
        </form><br>
    </body>
</html>
