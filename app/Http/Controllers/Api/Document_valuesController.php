<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Document_values;

class Document_valuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /// Mostrar una lista de 
        return Document_values::all();
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
            'document_id' => 'required',
            'parameter_name' => 'required',
            'parameter_value'  => 'required',
        ]);

        $obj = Document_values::create($request->all());
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
        return Document_values::findOrFail($id);
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
            'document_id' => 'required',
            'parameter_name' => 'required',
            'parameter_value'  => 'required',
        ]);

        $obj = Document_values::findOrFail($id);
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
        Document_values::destroy($id);
        return response()->json(null, 204);
    }
}
