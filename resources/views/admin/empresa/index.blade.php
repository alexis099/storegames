@extends('layouts.layout-admin')

@section('titulo', 'Empresas')

@section('contenido')
    <table class="table table caption-top" >
        <caption class="mb-2">
            <h1 class="display-3 mb-3">Empresas</h1>
            <a href="/empresa/agregar">Agregar nuevo</a>
            <span>&#8226;</span>
            <a href="/juego">Juegos</a>
            <span>&#8226;</span>
            <a href="#">Usuarios</a>
        </caption>
        <thead>
            <th>ID</th>
            <th>Nombre</th>
            <th>Pais</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($empresas as $empresa)
            <tr>
                <td>{{ $empresa['id'] }}</td>
                <td>{{ $empresa['nombre'] }}</td>
                <td>{{ $empresa['pais'] }}</td>
                <td><a href={{ "/empresa/eliminar/".$empresa['id'] }}>Eliminar</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection