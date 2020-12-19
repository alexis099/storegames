@extends('layouts.layout-principal')

@section('titulo', 'Compras')

@section('header')
    <link rel="stylesheet" href={{asset('css/compra.css')}}>
    <link rel="stylesheet" href={{asset('css/tablas.css')}}>
@endsection

@section('contenido')
    <h1 class="display-1 color-1">Compras</h1>
    <br> <br>
    <table class="tabla">
        <thead>
            <tr>
                <td>Título</td>
                <td style="width: 200px">Precio de compra</td>
                <td style="width: 200px">Fecha</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($compras as $item)
                <tr>
                    <td>
                        <a href={{"/juego/".$item->id_juego}}>
                        <img src={{asset($item->portada)}} width="64px" height="32px" alt="Portada"></a>
                        <span style="margin-left: 10px">{{$item->titulo}}</span>
                    </td>
                    <td style="width: 200px">{{'$'.$item->precio}}</td>
                    <td style="width: 400px">{{$item->fecha}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection


