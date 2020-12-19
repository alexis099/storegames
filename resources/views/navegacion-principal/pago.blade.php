@extends('layouts.layout-principal')

@section('titulo', 'Finalizar compra')

@section('header')
    <link rel="stylesheet" href={{asset('css/pago.css')}}>
@endsection

@section('contenido')
    <h1 class="display-1 color-1">Finalizar compra</h1>
    <div class="metodos">
        <h2 class="color-1 display-4">Método de pago</h2>

        <div style="text-align: center;">
            <div class="metodo seleccionado" onclick="elegir(this, 'frm1')">
                <img class="mp" src={{asset('img/visa.png')}} alt="">
            </div>
            <div class="metodo" onclick="elegir(this, 'frm1')">
                <img class="mp" src={{asset('img/mc.png')}} alt="">
            </div>
            <div class="metodo" onclick="elegir(this, 'frm2')">
                <img class="mp" src={{asset('img/mp.png')}} alt="">
            </div>
            <div class="metodo" onclick="elegir(this, 'frm3')">
                <img class="mp" src={{asset('img/ef.png')}} alt="">
            </div>
        </div>
    </div>

    <div class="formulario-tarjeta">
        <h2 class="color-1 display-5" id="dp">Datos del pago</h2>
        <br>
        <form action="/pago" method="POST" id="frm1">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label color-1 display-6">Nombre en la tarjeta</label>
                <input type="text" class="input width100" placeholder="Nombre" aria-label="Nombre" name="nombre" id="nombre" autocomplete="off">
            </div>
            
            <br>
            <div class="mb-3" style="display: flex; justify-content: space-between;">
                <div style="width: 100%;  margin-right: 10px">
                    <label for="numero" class="form-label color-1 display-6">Número</label>
                    <input type="text" class="input" name="numero" id="numero" style="width: 100%;" placeholder="Número de la tarjeta">
                </div>
                <div style="width: 100%;  margin-left: 10px">
                    <label for="codigo" class="form-label color-1 display-6">Código</label>
                    <div class="input-group">
                        {{-- <span class="input-group-text">123</span> --}}
                        <input type="text" class="input" name="codigo" id="codigo"  placeholder="Código de seguridad" autocomplete="off">
                    </div>
                </div>
            </div>

            <br>
            <div class="mb-3" style="display: flex; justify-content: space-between;">
                <div style="width: 100%;  margin-right: 10px">
                    <label for="dia" class="form-label color-1 display-6">Vencimiento</label>
                    <div class="input-group mb-3">
                        {{-- <span class="input-group-text">MM/AA</span> --}}
                        <input type="text" class="input" name="dia" id="dia" aria-label="Vencimiento" placeholder="MM/AA" autocomplete="off">
                    </div>
                </div>
                <div style="width: 100%;  margin-left: 10px"></div>
            </div>
            <div style="text-align: center;">
                <button class="a-btn a-btn-azul" type="submit">Finalizar</button>
            </div>
        </form>

        <div class="formulario-mp" id="frm2" style="display: none">
            <div style="text-align: center;">
                <button class="a-btn a-btn-azul">Conectar a Mercado Pago</button>
            </div>
        </div>
        <div class="formulario-ef" id="frm3" style="display: none">
            <div style="text-align: center;">
                <button class="a-btn a-btn-azul">Imprimir comprobante de pago</button>
            </div>
        </div>
    </div>

    <script>
        window.onload = () => {
            // document.getElementById("frm2").style.display = 'none';
            // document.getElementById("frm3").style.display = 'none';
        }

        function elegir(e, formulario) {
            document.getElementById("frm1").style.display = 'none';
            document.getElementById("frm2").style.display = 'none';
            document.getElementById("frm3").style.display = 'none';


            if(!e.classList.contains('seleccionado')) {
                let elementos = document.getElementsByClassName('metodo');
                Array.from(elementos).forEach(item => {
                    item.classList.remove('seleccionado');
                });
                e.classList.add('seleccionado');

                document.getElementById(formulario).style.display = 'block';
            }
        }
    </script>
@endsection