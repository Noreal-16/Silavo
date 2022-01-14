<?php

namespace App\Http\Controllers;

use App\Models\Resultado;
use Illuminate\Http\Request;use Illuminate\Support\Facades\DB;

use Yajra\DataTables\Facades\DataTables as DataTables;

class ResultadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $subcontenido = DB::select('CALL dbSubContenidos()');
            return DataTables::of($subcontenido)
                ->addIndexColumn('')
                ->addColumn('action', function($subcontenido){
                    $acciones ='<a href="javascript:void(0)" onclick="" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" name="delete"  class="delete btn btn-danger btn-sm">Delete</a>';
                    //$acciones .='<button type="button" name="delete" id="" class="btn btn-danger btn-sm>Eliminar</button>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('index.resultadoAp');
    }

    public function cargaDatosComboResultados(Request $request)
    {
        if ($request->ajax()){
            $resultado = DB::select('CALL dbResAprendizaje()');
            return response()->json($resultado);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resultado = new Resultado;
        $resultado->nombreResultado=$request->input('resAprendizaje');
        $resultado->informacion_id=$request->input('nComboAsignatura');
        $resultado->save();
        return redirect()->route('resultados.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resultado  $resultado
     * @return \Illuminate\Http\Response
     */
    public function show(Resultado $resultado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resultado  $resultado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resultado $resultado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resultado  $resultado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resultado $resultado)
    {
        //
    }
}
