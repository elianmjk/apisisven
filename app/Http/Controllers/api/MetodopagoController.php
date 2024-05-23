<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Metodopago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MetodopagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Metodopago::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // Validar la solicitud
       $validator = Validator::make($request->all(), [
        'nombre' => 'required|string|max:255',
        'titulardelacuenta' => 'required|string|max:255',
        'numerocuenta' => 'required|integer',
    ]);

    // Verificar si la validación falla
    if ($validator->fails()) {
        return response()->json([
            'msg' => 'Se produjo un error en las validaciones de la información',
            'statuscode' => 422,
            'errors' => $validator->errors()
        ], 422);
    }

    // Crear el nuevo método de pago
    $metodoPago = MetodoPago::create([
        'nombre' => $request->nombre,
        'titulardelacuenta' => $request->titulardelacuenta,
        'numerocuenta' => $request->numerocuenta,
    ]);

    return response()->json(['metodo_pago' => $metodoPago], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $metodoPago = MetodoPago::find($id);

        if (!$metodoPago) {
            return response()->json(['message' => 'Método de pago no encontrado'], 404);
        }

        return response()->json(['metodo_pago' => $metodoPago]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $metodoPago = MetodoPago::find($id);

        if (!$metodoPago) {
            return response()->json(['message' => 'Método de pago no encontrado'], 404);
        }

        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|max:255',
            'titulardelacuenta' => 'sometimes|required|string|max:255',
            'numerocuenta' => 'sometimes|required|integer',
        ]);

        // Verificar si la validación falla
        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en las validaciones de la información',
                'statuscode' => 422,
                'errors' => $validator->errors()
            ], 422);
    }}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $metodoPago = MetodoPago::find($id);

        if (!$metodoPago) {
            return response()->json(['message' => 'Método de pago no encontrado'], 404);
        }

        $metodoPago->delete();

        return response()->json(['message' => 'Método de pago eliminado correctamente']);
    }
}
