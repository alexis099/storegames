<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

use App\Models\Juego;
use App\Models\Imagen;
use App\Models\Empresa;

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
        return view('navegacion-principal/juego')
                ->with('imagenes', $imagenes)
                ->with('juego', $juego);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Ver las imagenes de un juego.
     *
     * @return \Illuminate\Http\Response
     */
    public function imagenes($id)
    {
        $imagenes = Imagen::where('id_juego', $id)->get();
        // $imagen = Imagen::find(2);
        return view('admin.juego.imagenes')->with('imagenes', $imagenes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas = Empresa::all();
        return view('admin.juego.nuevo')->with('empresas', $empresas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        return redirect('/juego');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
