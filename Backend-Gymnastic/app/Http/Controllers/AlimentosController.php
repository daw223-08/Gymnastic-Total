<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alimento;
use App\Models\Dieta_Alimento;

class AlimentosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alimentos = Alimento::get();

        if ($alimentos) {
            $response["status"] = 1;
            $response["message"] = "Alimentos listados con éxito";
            $response["code"] = 200;
            $response["alimentos"] = $alimentos;
        } else {
            $response["status"] = 0;
            $response["message"] = "Error al obtener los alimentos";
            $response["code"] = 404;
        }

        return response()->json($response);
    }


    /**
     * Display a listing of the resource.
     */
    public function listarAlimentosPorUsuario($id)
    {
        try {

            $userId = $id; // ID del usuario
        
            $alimentos = Alimento::where('id_usuario', $userId)->get();
        
            if ($alimentos) {
                $response["status"] = 1;
                $response["message"] = "Alimentos listados con éxito";
                $response["code"] = 200;
                $response["alimentos"] = $alimentos;
            } else {
                $response["status"] = 0;
                $response["message"] = "Error al obtener los alimentos";
                $response["code"] = 404;
            }
        } catch (\Exception $e) {
            $response["status"] = 0;
            $response["message"] = "Error al obtener los alimentos";
            $response["code"] = 500;
        }
        
        return response()->json($response);
    }


    /**
     * Display a listing of the resource.
     */
    public function show()
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function indexOne($id)
    {

        $alimento = Alimento::where("id", $id)->first();

        if ($alimento) {

            if ($alimento) {
                $response["status"] = 1;
                $response["message"] = "Alimento encontrado con éxito";
                $response["code"] = 200;
                $response["alimento"] = $alimento;
            } else {
                $response["status"] = 0;
                $response["message"] = "Alimento no encontrado";
                $response["code"] = 404;
            }

        } else {
            $response["status"] = 0;
            $response["message"] = "Alimento no encontrado";
            $response["code"] = 404;
        }

        return response()->json($response);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $alimento = Alimento::create([
                "nombre" => $request->nombre,
                "cantidad" => $request->cantidad,
                "familia" => $request->familia,
                "horario_ingesta" => $request->horario_ingesta,
                "dia" => $request->dia,
                "kcal" => $request->kcal,
                "id_usuario" => $request->id_usuario,
            ]);

            if ($alimento) {

                $response["status"] = 1;
                $response["message"] = "Alimento registrado con éxito";
                $response["code"] = 200;

            } else {

                $response["status"] = 0;
                $response["message"] = "Error al insertar el alimento";
                $response["code"] = 404;
            }

        } catch (\Exception $e) {

            $response["status"] = 2;
            $response["message"] = "Por favor, rellena todos los campos";
            $response["code"] = 500;
        }

        return response()->json($response);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $alimento = Alimento::find($id);

            if (!$alimento) {

                $response["status"] = 0;
                $response["message"] = "Alimento no encontrado";
                $response["code"] = 404;

            } else {
                $alimento->nombre = $request->nombre;
                $alimento->cantidad = $request->cantidad;
                $alimento->familia = $request->familia;
                $alimento->horario_ingesta = $request->horario_ingesta;
                $alimento->dia = $request->dia;
                $alimento->kcal = $request->kcal;
                $alimento->id_usuario = $request->id_usuario;

                $alimento->save();

                $response["status"] = 1;
                $response["message"] = "Alimento actualizado con éxito";
                $response["code"] = 200;
            }

        } catch (\Exception $e) {

            $response["status"] = 2;
            $response["message"] = "Por favor, rellena todos los campos";
            $response["code"] = 500;
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $alimento = Alimento::find($id);

        if (!$alimento) {

            $response["status"] = 0;
            $response["message"] = "El alimento no existe";
            $response["code"] = 404;

        } else {

            $alimento->dietas()->detach();
            $alimento->delete();

            $response["status"] = 1;
            $response["message"] = "Alimento eliminado";
            $response["code"] = 200;

        }

        return response()->json($response);

    }
}