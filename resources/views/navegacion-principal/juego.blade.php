@extends('layouts.layout-principal')

@section('titulo', $juego->titulo)

@section('header')
    <link rel="stylesheet" href={{ asset('css/juego.css') }}>
@endsection

@section('contenido')
    <div class="informacion">
        <div class="visualizacion-imagenes">
            <img id="imagen-principal" alt="">
            <button class="btn-desplazamiento" id="bot-anterior"><i class="fas fa-angle-double-left"></i></button>
            <button class="btn-desplazamiento" id="bot-siguiente"><i class="fas fa-angle-double-right"></i></button>
        </div>
        <div class="info">
            <div>
                <h1 class="titulo display-3">{{ $juego->titulo }}</h1>
                <div class="precio display-4">$ {{ $juego->precio }}</div>
            </div>
            @if ($existe === '1')
                <a class="link-comprar" href={{"/eliminar-carrito/".$carrito}}>Eliminar del carrito</a>
            @else
                <a class="a-btn a-btn-azul" style="width: 400px; text-align: center; font-size: 1.23rem; line-height: 50px;" href={{"/agregar-carrito/".$juego->id}}>Agregar al carrito</a>
            @endif
        </div>
    </div>
    <div style="margin: .25em; padding: 1em">
        <h2 class="titulo display-3 mt-5">Informaci&oacute;n</h2>
        <span class="descripcion">{{ $juego->descripcion }}</span>
    </div>

    <script>
        const img_principal = document.querySelector('#imagen-principal');
        const bot_anterior = document.querySelector('#bot-anterior');
        const bot_siguiente = document.querySelector('#bot-siguiente');

        var imagenes = {!! json_encode($imagenes) !!};
        var indice_imagen = 0;
        ponerImagen();

        bot_anterior.addEventListener('click', function(e) {
            indice_imagen--;
            if(indice_imagen < 0) indice_imagen = imagenes.length - 1;
            ponerImagen();
        });
        
        bot_siguiente.addEventListener('click', function(e) {
            indice_imagen++;
            if(indice_imagen >= imagenes.length) indice_imagen = 0;
            ponerImagen();
        });

        function ponerImagen() {
            img_principal.src = "/" + imagenes[indice_imagen].archivo;
        }
    </script>
@endsection