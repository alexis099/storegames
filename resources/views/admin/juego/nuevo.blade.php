@extends('layouts.layout-admin')

@section('titulo', 'Agregar juego')

@section('contenido')
    <caption class="mb-2">
        <h1 class="display-3 mb-3">Agregar juego</h1>
    </caption>
    <form action="/admin/juego/guardar", method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" autocomplete="off" >
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripcion</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1">$</span>
                <input type="number" class="form-control" id="precio" name="precio" >
            </div>
        </div>

        <div class="mb-3">
            <label for="desarrolladora" class="form-label">Desarrolladora</label>
            <select class="form-select" id="desarrolladora" name="desarrolladora">
                <option selected>-- Elegir --</option>
                @foreach ($empresas as $empresa)
                    <option>{{ $empresa->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="distribuidora" class="form-label">Distribuidora</label>
            <select class="form-select" id="distribuidora" name="distribuidora">
                <option selected>-- Elegir --</option>
                @foreach ($empresas as $empresa)
                    <option>{{ $empresa->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha de lanzamiento</label>
            <input type="date" class="form-control" name="fecha" id="fecha" >
        </div>

        <div class="mb-3">
            <label for="imagenes" class="form-label">Imagenes</label>
            <input type="file" multiple class="form-control" name="imagenes[]" id="imagenes" >
            <br>
            <label for="portada" class="form-label">Portada</label>
            <input type="file" class="form-control" name="portada" id="portada" >
        </div>

        <button type="submit" class="btn btn-primary" >Agregar</button>
    </form>
@endsection