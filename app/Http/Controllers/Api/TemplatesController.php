<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Templates;

class TemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /// Mostrar una lista de 
        return Templates::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar y guardar un nuevo  en la base de datos
        $request->validate([
            'name' => 'required',
            'content' => 'required',
            'header' => 'required',
            'count_parameters' => 'required',
            'count_signatures' => 'required',
            'user_created' => 'required',
            'topic_id' => 'required',
            'classification_id' => 'required',
        ]);

        $obj = Templates::create($request->all());
        return response()->json($obj, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Mostrar un producto específico
        return Templates::findOrFail($id);
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
        // Validar y actualizar un  específico en la base de datos
        $request->validate([
            'name' => 'required',
            'content' => 'required',
            'header' => 'required',
            'count_parameters' => 'required',
            'count_signatures' => 'required',
            'user_created' => 'required',
            'topic_id' => 'required',
            'classification_id' => 'required',
        ]);

        $obj = Templates::findOrFail($id);
        $obj->update($request->all());
        return response()->json($obj);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Eliminar un específico de la base de datos
        Templates::destroy($id);
        return response()->json(null, 204);
    }
}
