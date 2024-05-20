<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = DB::table('clientes')
        ->join('categorias', 'clientes.categorias_id', '=', 'categorias.categorias_id')
        ->select('clientes.*', 'categorias.nombre as categoria_nombre')
        ->get();

     return response()->json(['clientes' => $clientes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => ['required', 'max:255'],
            'direccion' => ['required', 'max:255'],
            'categorias_id' => ['required', 'exists:categorias,categorias_id'],
            'telefono' => ['required', 'max:15'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en las validaciones de la información',
                'statuscode' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->direccion = $request->direccion;
        $cliente->categorias_id = $request->categorias_id;
        $cliente->telefono = $request->telefono;
        $cliente->save();

        return response()->json(['cliente' => $cliente], 201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $clientes=Cliente::find($id);
        if(is_null($clientes)){
            return abort(404);
        }
        $categorias=DB::table('categorias')
        ->orderBy('categorias.nombre')
        ->get();
        return response()->json(['clientes'=>$clientes,'categorias'=>$categorias]);
    

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => ['sometimes', 'required', 'max:255'],
            'direccion' => ['sometimes', 'required', 'max:255'],
            'categorias_id' => ['sometimes', 'required', 'exists:categorias,categorias_id'],
            'telefono' => ['sometimes', 'required', 'max:15'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en las validaciones de la información',
                'statuscode' => 422,
                'errors' => $validator->errors(),
            ]);
        }
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        $cliente->nombre = $request->nombre ?? $cliente->nombre;
        $cliente->direccion = $request->direccion ?? $cliente->direccion;
        $cliente->categorias_id = $request->categorias_id ?? $cliente->categorias_id;
        $cliente->telefono = $request->telefono ?? $cliente->telefono;
        $cliente->save();

        return response()->json(['cliente' => $cliente]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = Cliente::find($id);
        
        if (is_null($cliente)) {
            return abort(404);
        }

        $cliente->delete();

        $clientes = DB::table('clientes')
            ->join('categorias', 'clientes.categorias_id', '=', 'categorias.categorias_id')
            ->select('clientes.*', 'categorias.nombre as categoria_nombre')
            ->get();

        return response()->json(['clientes' => $clientes, 'success' => true]);
    }
}
