@extends('layouts.layout-principal')

@section('titulo', 'Pagina Principal')

@section('header')
    <link rel="stylesheet" href={{ asset('css/inicio.css') }} >
@endsection

@section('contenido')
<div class="articulos">
    @foreach ($juegos as $juego)
    <a href={{ "/juego/".$juego->id }} style="display: inline-block">
        <div class="articulo">
            <img class="imagen" src=" {{ asset($juego->portada) }} " alt="">
        </div>
    </a>
    @endforeach
</div>
@endsection