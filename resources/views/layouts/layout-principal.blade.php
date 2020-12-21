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
    <div style="position: relative; margin-bottom: 4.77em; z-index: 0">
        <section class="superior busqueda-activa" id="superior">
            <nav class="nav">
                <ul class="accesos dflex align-center height100">
                    <li class="acceso"><a href="/"><img src={{asset('img/logo.png')}} alt="Logo" id="logo"></a></li>
                    <li class="acceso">CATEGORÍAS</li>
                    <li class="acceso">BIBLIOTECA</li>
                    <li class="acceso">LISTA DE DESEADOS</li>
                    <li class="acceso" ><a class="a color-1" href="/buscar" onclick="
                    event.preventDefault(); 
                    document.querySelector('#busqueda').classList.toggle('activado');
                    document.querySelector('#busqueda').classList.toggle('desactivado');
                    document.querySelector('#superior').classList.toggle('busqueda-activa');
                        ">Buscar</a></li>
                </ul>
                <section class="cuenta dflex height100">
                    @if (Auth::check())
                        <div style="margin-right: 10px">
                            <li class="li-cuenta"><a class="a color-1" href="/dashboard">{{Auth::user()->name}}</a></li>
                            <div>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <a class="a color-1" href="/dashboard">Cuenta</a>
                                    <span>&#8226;</span>
                                    <a class="a color-1" href="/logout" onclick="event.preventDefault();
                                    this.closest('form').submit();">Cerrar sesión</a>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="dflex align-center" style="flex-direction: column;">
                            <li class="li-cuenta"><a class="a color-1" href="/login">Iniciar Sesión</a></li>
                            <a class="a-btn a-btn-verde" href="#" id="btn-descargar-aplicacion">DESCARGAR APLICACIÓN</a>
                        </div>
                    @endif
                </section>
            </nav>
        </section>
        <div class="desactivado" id="busqueda">
            <input id="input-busqueda" type="text">
        </div>
    </div>

    <div class="contenedor">
        @yield('contenido')
    </div>
</body>
</html>