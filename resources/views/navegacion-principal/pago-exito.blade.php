@extends('layouts.layout-principal')

@section('titulo', 'Finalizar compra');

@section('header')
    <link rel="stylesheet" href={{asset('css/pago.css')}}>
@endsection 

@section('contenido')
    <h2 class="display-1 color-1">¡Compra finalizada!</h2>

    <span class="display-6 color-1">Tu compra ha sido agregada a tu biblioteca.</span>
@endsection