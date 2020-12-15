@extends('layouts.layout-admin')

@section('titulo', 'Juegos')

@section('contenido')
    <table class="table table caption-top" >
        <caption class="mb-2">
            <h1 class="display-3 mb-3">Juegos</h1>
            <a href="/juego/agregar">Agregar nuevo</a>
            <span>&#8226;</span>
            <a href="/empresa">Empresas</a>
            <span>&#8226;</span>
            <a href="#">Usuarios</a>
        </caption>
        <thead>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Desarrollado</th>
            <th>Distribuido</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($juegos as $juego)
            <tr>
                <td>{{ $juego->id }}</td>
                <td>{{ $juego->titulo }}</td>
                <td>{{ $juego->precio }}</td>
                <td>{{ $juego->distribuidora }}</td>
                <td>{{ $juego->desarrolladora }}</td>
                <td>
                    <a href={{ "/juego/".$juego->id.'/imagenes' }}>Imagenes</a>
                    <a href={{ "/juego/eliminar/".$juego->id }}>Eliminar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection