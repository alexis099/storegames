<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <link rel="stylesheet" href={{ asset("css/config.css") }}>
    <link rel="stylesheet" href={{ asset("css/layout-principal.css") }}>
    <link rel="icon" type="image/ico" href={{asset('img/favico.ico')}} sizes="32x32">
    <script src="https://kit.fontawesome.com/06449665b4.js" crossorigin="anonymous"></script>
    <title>@yield('titulo') - StoreGames</title>
    @section('header')
    @show
</head>
<body>
    <section class="superior">
        <nav class="nav">
            <ul class="accesos">
                <li class="acceso">TIENDA</li>
                <li class="acceso">BIBLIOTECA</li>
                <li class="acceso">LISTA DE DESEADOS</li>
            </ul>
            <ul class="cuenta">
                <li class="li-cuenta">Crear Cuenta</li>
                <li class="li-cuenta">Iniciar Sesión</li>
            </ul>
        </nav>
    </section>

    <div class="contenedor">
        @yield('contenido')
    </div>
</body>
</html>