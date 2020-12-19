@extends('layouts.layout-principal')

@section('titulo', 'Carrito')

@section('header')
    <link rel="stylesheet" href={{ asset('css/carrito.css') }}>
@endsection 

@section('contenido')
    <h1 class="color-1 display-1">Carrito</h1>
    @foreach ($items as $item)
        <div class="item">
            <div class="info">
                <h2 class="color-1 display-6">{{ $item->titulo }}</h2>
                <p class="item__fecha-agregado color-3">{{'Agregado el '.$item->fecha_agregado}}</p>
                <span class="item__precio color-2 display-6">{{'$'.$item->precio}}</span>
                <br>
                <a class="a-btn a-btn-verde" href={{'/eliminar-carrito/'.$item->id}}>ELIMINAR</a>
            </div>
            <div class="portada">
                <img class="item__portada" src={{asset($item->portada)}} alt="">
            </div>
        </div>
    @endforeach 
    
    @if (count($items) === 0)
        <h2 class="titulo display-6 color-1" style="text-align: center">No hay ítems.</h2>
    @else
        <div class="finalizar" style="margin-bottom: 120px; margin:1em; padding: 1em;">
            <h2 class="color-1 display-6" >Total: <strong class="color-2">{{'$'.$total}}</strong></h2>
            <a class="a-btn a-btn-azul" href="/pago">Finalizar compra</a>
        </div>
    @endif
@endsection