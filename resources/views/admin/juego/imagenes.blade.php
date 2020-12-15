@extends('layouts.layout-admin')

@section('titulo', 'Imagenes')

@section('contenido')
    @foreach ($imagenes as $imagen)
        <img src="{{ asset($imagen->archivo) }}">
    @endforeach
@endsection