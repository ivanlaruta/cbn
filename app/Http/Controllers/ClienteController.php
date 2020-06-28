<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use DB;
class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function finder(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return \Response::json([]);
        }

        // $tags = Trf_Cliente::search($term)->limit(5)->get();
        $tags =DB::select( DB::raw("
           select distinct Cliente,Razon_Social
            from envases
            where Razon_Social like '%".$term."%'
            limit 15
        "));
       

        $formatted_tags = [];

        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->Cliente,'text' => $tag->Razon_Social];
        }

        return \Response::json($formatted_tags);
    }

    public function consulta(Request $request)
    {
        // dd($request->all());
        $flag = 0;
        if (!empty($request->cliente) && $request->cliente==$request->codigo) {
                $flag = 1 ;
                $bultos =DB::select( DB::raw("
                select  Razon_Social,Producto,Descripcion,Bultos,fecha_corte
                from envases
                where Cliente = ".$request->codigo
            ));
                 // dd($bultos);
           return view('tabla')
             ->with('bultos',$bultos)
            ->with('flag',$flag);
        }
        return view('tabla')->with('flag',$flag);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
