<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();

        return response()->json(['categorias' => $categorias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => ['required', 'max:255'],
            'descripcion' => ['required'],
            'codigo' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en las validaciones de la información',
                'statuscode' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->codigo = $request->codigo;
        $categoria->save();

        return response()->json(['categoria' => $categoria], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = Categoria::find($id);

        if (is_null($categoria)) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }

        return response()->json(['categoria' => $categoria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categoria = Categoria::find($id);

        if (is_null($categoria)) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => ['sometimes', 'required', 'max:255'],
            'descripcion' => ['sometimes', 'required'],
            'codigo' => ['sometimes', 'required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en las validaciones de la información',
                'statuscode' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        $categoria->update($request->all());

        return response()->json(['categoria' => $categoria]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoria = Categoria::find($id);

        if (is_null($categoria)) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }

        $categoria->delete();

        return response()->json(['message' => 'Categoría eliminada correctamente']);
    }
}
