<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

use App\Models\Juego;
use App\Models\Imagen;
use App\Models\Empresa;
use App\Models\Carrito;
use App\Models\Compra;

class CompraController extends Controller
{
    public function index()
    {
        if(! Auth::check()) {
            return redirect('/');
        }

        $compras = DB::table('compra')
                    ->join('juego', function($join) {
                        $join->on('compra.id_juego', '=', 'juego.id')
                        ->where('compra.id_usuario', '=', Auth::id());
                    })
                    ->select(
                        'compra.created_at as fecha',
                        'compra.precio as precio',
                        'juego.id as id_juego',
                        'juego.titulo as titulo',
                        'juego.portada as portada',
                    )->get();

        return view('navegacion-principal.compra')->with('compras', $compras);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if(! Auth::check()) {
            return redirect('/');
        }

        $id_usuario = Auth::id();
        $carrito = Carrito::where('id_usuario', '=', $id_usuario)->get();

        foreach($carrito as $item) {
            $compra = new Compra;
            $compra->id_usuario = $id_usuario;

            $juego = Juego::find($item->id_juego);
            $compra->id_juego = $juego->id;
            $compra->precio = $juego->precio;
            
            $compra->save();
            $item->delete();
        }
        
        // return redirect('/pago/exito');
        return view('navegacion-principal.pago-exito');
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
