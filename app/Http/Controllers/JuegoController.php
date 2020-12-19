<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Juego;
use App\Models\Imagen;
use App\Models\Empresa;
use App\Models\Carrito;

class JuegoController extends Controller
{
    public function principal() {
        $juegos = DB::table('juego')
                ->join('empresa as distribuidora', 'juego.distribuidora', '=', 'distribuidora.id')
                ->join('empresa as desarrolladora', 'juego.desarrolladora', '=', 'desarrolladora.id')
                ->select(
                    'distribuidora.nombre as distribuidora',
                    'desarrolladora.nombre as desarrolladora',
                    'juego.id',
                    'juego.titulo',
                    'juego.descripcion',
                    'juego.precio',
                    'juego.fecha_publicacion',
                    'juego.portada',
                )
                ->get();
        $imagenes = [];
        for($i = 0, $size = count($juegos); $i < $size; ++$i) {
            $id = $juegos[$i]->id;
            $path = Imagen::where('id_juego', $id)->first();
            $imagenes[$i] = $path;
        }
        return view('navegacion-principal.inicio')->with('juegos', $juegos)->with('imagenes', $imagenes);
    }
    
    public function ver($id)
    {
        $imagenes = Imagen::where('id_juego', $id)->get();
        $juego = Juego::find($id);
        $existe = '0';
        $carrito = '-1';

        if (Auth::check()) {
            $id_usuario = Auth::id();
            $items = Carrito::where('id_juego', '=', $id)->where('id_usuario', '=', $id_usuario)->get();
            if(count($items) > 0) {
                $existe = '1';
                $carrito = $items[0]->id;
            }
        }

        return view('navegacion-principal/juego')
            ->with('imagenes', $imagenes)
            ->with('juego', $juego)
            ->with('existe', $existe)
            ->with('carrito', $carrito);
    }

    public function agregar_carrito($id)
    {
        $id_usuario = Auth::id();
        $carrito = new Carrito;
        $carrito->id_juego = $id;
        $carrito->id_usuario = $id_usuario;
        $carrito->save();
        return redirect('/carrito');
    }

    public function index()
    {
        $juegos = DB::table('juego')
                ->join('empresa as distribuidora', 'juego.distribuidora', '=', 'distribuidora.id')
                ->join('empresa as desarrolladora', 'juego.desarrolladora', '=', 'desarrolladora.id')
                ->select(
                    'distribuidora.nombre as distribuidora',
                    'desarrolladora.nombre as desarrolladora',
                    'juego.id',
                    'juego.titulo',
                    'juego.descripcion',
                    'juego.precio',
                    'juego.fecha_publicacion',
                    'juego.portada',
                )
                ->get();

        return view('admin.juego.index')->with('juegos', $juegos);
        // return $juegos;
    }

    public function imagenes($id)
    {
        $imagenes = Imagen::where('id_juego', $id)->get();
        // $imagen = Imagen::find(2);
        return view('admin.juego.imagenes')->with('imagenes', $imagenes);
    }

    public function create()
    {
        $empresas = Empresa::all();
        return view('admin.juego.nuevo')->with('empresas', $empresas);
    }

    public function store(Request $request)
    {
        $juego = new Juego;
        $juego->titulo = $request->nombre;
        $juego->descripcion = $request->descripcion;
        $juego->precio = $request->precio;

        $desarrolladora = Empresa::where('nombre', $request->desarrolladora)->first();
        $distribuidora = Empresa::where('nombre', $request->distribuidora)->first();
        $juego->desarrolladora = $desarrolladora->id;
        $juego->distribuidora = $distribuidora->id;

        $juego->fecha_publicacion = $request->fecha;
        $portada = $request->file('portada')->store('juegos/imagenes', 'public');
        $juego->portada = $portada;
        $juego->save();

        if($files=$request->file('imagenes')){
            foreach($files as $file){
                $path = $file->store('juegos/imagenes', 'public');
                $imagen = new Imagen;
                $imagen->archivo = $path;
                $imagen->id_juego = $juego->id;
                $imagen->save();
            }
        }

        // $path = $request->file('imagen')->store('juegos/imagenes', 'public');
   
        // $url = Storage::url($path);

        // return view('juego.verimagen')->with('imagen', $url);
        return redirect('/admin/juego');
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
