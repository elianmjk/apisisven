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
<<<<<<< HEAD
    
    $categorias= Categoria::all();
    return response()->json(['categorias' => $categorias]);

=======
        $categorias = Categoria::all();
        return response()->json(['categorias' => $categorias]);
>>>>>>> 4be678d84fe16cfe8fb0b361c0aee3a3840572f7
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
        // Validar la solicitud
=======
<<<<<<< HEAD
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'codigo' => 'required|integer',
        ]);

        // Verificar si la validación falla
=======
>>>>>>> 377938933568a9989285728d14bb19eefb9308c1
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'codigo' => 'required|integer',
        ]);

>>>>>>> 4be678d84fe16cfe8fb0b361c0aee3a3840572f7
        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en las validaciones de la información',
                'statuscode' => 422,
<<<<<<< HEAD
                'errors' => $validator->errors()
            ], 422);
=======
<<<<<<< HEAD
                'errors' => $validator->errors()
            ], 422);
        }

        // Crear la nueva categoría
        $categorias = new Categoria;
        $categorias=$request->nombre;
        $categorias=$request->descripcion;
        $categorias=$request->codigo;
        $categorias->save();
         
        return response()->json(['categorias' => $categorias], 201);
=======
                'errors' => $validator->errors(),
            ]);
>>>>>>> 377938933568a9989285728d14bb19eefb9308c1
        }

        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->codigo = $request->codigo;
        $categoria->save();

        return response()->json(['categoria' => $categoria], 201);
>>>>>>> 4be678d84fe16cfe8fb0b361c0aee3a3840572f7
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = Categoria::find($id);

<<<<<<< HEAD
        if (!$categoria) {
=======
        if (is_null($categoria)) {
>>>>>>> 4be678d84fe16cfe8fb0b361c0aee3a3840572f7
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

<<<<<<< HEAD
        if (!$categoria) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }

        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|max:255',
            'descripcion' => 'sometimes|required|string|max:255',
            'codigo' => 'sometimes|required|integer',
        ]);

        // Verificar si la validación falla
=======
        if (is_null($categoria)) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => ['sometimes', 'required', 'max:255'],
            'descripcion' => ['sometimes', 'required'],
            'codigo' => ['sometimes', 'required', 'integer'],
        ]);

>>>>>>> 4be678d84fe16cfe8fb0b361c0aee3a3840572f7
        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en las validaciones de la información',
                'statuscode' => 422,
<<<<<<< HEAD
                'errors' => $validator->errors()
            ], 422);
        }
        
        $categoria = new Categoria;
        $categoria=$request->nombre;
        $categoria=$request->descripcion;
        $categoria=$request->codigo;
        $categoria->save();

        return response()->json(['categorias' => $categoria]);
=======
                'errors' => $validator->errors(),
            ]);
        }
        
        $categoria = new Categoria;
        $categoria=$request->nombre;
        $categoria=$request->descripcion;
        $categoria=$request->codigo;
        $categoria->save();

<<<<<<< HEAD
        return response()->json(['categorias' => $categoria]);
=======
        $categoria->update($request->all());

        return response()->json(['categoria' => $categoria]);
>>>>>>> 4be678d84fe16cfe8fb0b361c0aee3a3840572f7
>>>>>>> 377938933568a9989285728d14bb19eefb9308c1
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoria = Categoria::find($id);

<<<<<<< HEAD
        if (!$categoria) {
=======
        if (is_null($categoria)) {
>>>>>>> 4be678d84fe16cfe8fb0b361c0aee3a3840572f7
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }

        $categoria->delete();

        return response()->json(['message' => 'Categoría eliminada correctamente']);
    }
}
