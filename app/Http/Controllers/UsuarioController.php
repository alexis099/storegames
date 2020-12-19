<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UsuarioController extends Controller
{
    public function carrito() {
        $items = DB::table('carrito')
                ->join('users', function($join) {
                    $join->on('carrito.id_usuario', '=', 'users.id')
                         ->where('users.id', '=', Auth::id());
                })
                ->join('juego', 'carrito.id_juego', '=', 'juego.id')
                ->select(
                    'carrito.id as id',
                    'carrito.created_at as fecha_agregado',
                    'juego.titulo as titulo',
                    'juego.precio as precio',
                    'juego.portada as portada',
                    'juego.id as id_juego'
                )->get();
        $total = 0;
        foreach($items as $item) {
            $total += $item->precio;
        }
        $vacio = $total === 0 ? '0' : '1';
        return view('navegacion-principal.carrito')
                ->with('items', $items)
                ->with('total', $total)
                ->with('vacio', $vacio);
    }

    public function pago()
    {
        return view('navegacion-principal.pago');
    }

    public function pago_exito()
    {
        return view('navegacion-principal.pago-exito');
    }


    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
