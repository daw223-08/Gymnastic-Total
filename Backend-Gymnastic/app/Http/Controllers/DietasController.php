<?php

namespace App\Http\Controllers;


use App\Models\Dieta;
use App\Models\Dieta_Alimento;
use App\Models\User;
use Illuminate\Http\Request;

class DietasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dieta = Dieta::get();

        if ($dieta) {
            $response["status"] = 1;
            $response["message"] = "Dietas encontradas con éxito";
            $response["code"] = 200;
            $response["dietas"] = $dieta;

        } else {
            $response["status"] = 0;
            $response["message"] = "Dietas no encontradas";
            $response["code"] = 404;
        }

        return response()->json($response);
    }

    public function indexOne($id)
    {

        $dieta = Dieta::where("id", $id)->first();

        if ($dieta) {

            if ($dieta) {
                $response["status"] = 1;
                $response["message"] = "Dieta encontrada con éxito";
                $response["code"] = 200;
                $response["dieta"] = $dieta;
            } else {
                $response["status"] = 0;
                $response["message"] = "Dieta no encontrada";
                $response["code"] = 404;
            }

        } else {
            $response["status"] = 0;
            $response["message"] = "Dieta no encontrada";
            $response["code"] = 404;
        }

        return response()->json($response);

    }

    public function listarDietasPorUsuario($id)
    {
        $dietas = Dieta::where('id_usuario', $id)->get();

        if ($dietas->isNotEmpty()) {
            $response["status"] = 1;
            $response["message"] = "Dietas encontradas con éxito";
            $response["code"] = 200;
            $response["dietas"] = [];

            foreach ($dietas as $dieta) {
                $dietaData = [
                    'id' => $dieta->id,
                    'nombre' => $dieta->nombre,
                    'tipo' => $dieta->tipo,
                    'descripcion' => $dieta->descripcion,
                    'id_usuario' => $dieta->id_usuario,
                    'alimentos' => $dieta->alimentos()->get()
                ];

                $response["dietas"][] = $dietaData;
            }
        } else {
            $response["status"] = 0;
            $response["message"] = "No tienes dietas creadas";
            $response["code"] = 404;
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {

            $usuario = User::find($request->dieta["id_usuario"]);

            if ($usuario) {
                $dieta = Dieta::create([
                    "nombre" => $request->dieta["nombre"],
                    "tipo" => $request->dieta["tipo"],
                    "descripcion" => $request->dieta["descripcion"],
                    "id_usuario" => $request->dieta["id_usuario"],
                ]);

                if ($dieta) {
                    $response["status"] = 1;
                    $response["message"] = "Dieta registrada con éxito";
                    $response["code"] = 200;

                    $id_dieta = $dieta->id;
                    $id_alimentos = $request->id_alimentos;
                    $id_usuario = $usuario->id;

                    foreach ($id_alimentos as $id_alimento) {
                        Dieta_Alimento::create([
                            "id_dieta" => $id_dieta,
                            "id_alimento" => $id_alimento,
                            "id_usuario" => $id_usuario
                        ]);
                    }
                } else {
                    $response["status"] = 0;
                    $response["message"] = "Error al insertar la dieta";
                    $response["code"] = 404;
                }
            } else {
                $response["status"] = 0;
                $response["message"] = "El usuario no existe";
                $response["code"] = 404;
            }

        } catch (\Exception $e) {

            $response["status"] = 2;
            $response["message"] = "Por favor, rellena todos los campos sin repetir alimentos";
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
            $usuario = User::find($request->dieta["id_usuario"]);

            if ($usuario) {

                $dieta = Dieta::find($id);

                if ($dieta) {

                    $dieta->nombre = $request->dieta["nombre"];
                    $dieta->tipo = $request->dieta["tipo"];
                    $dieta->descripcion = $request->dieta["descripcion"];
                    $dieta->id_usuario = $request->dieta["id_usuario"];

                    if ($dieta->save()) {
                        
                        
                        $id_dieta = $dieta->id;
                        $id_alimentos = $request->id_alimentos;
                        $id_usuario = $usuario->id;

                        // Eliminar registros existentes en la tabla Dieta_Alimento para la id_dieta actual
                        Dieta_Alimento::where('id_dieta', $id_dieta)->delete();

                        foreach ($id_alimentos as $id_alimento) {
                            Dieta_Alimento::create([
                                "id_dieta" => $id_dieta,
                                "id_alimento" => $id_alimento,
                                "id_usuario" => $id_usuario
                            ]);
                        }

                        $response["status"] = 1;
                        $response["message"] = "Dieta actualizada con éxito";
                        $response["code"] = 200;

                    } else {
                        $response["status"] = 0;
                        $response["message"] = "Error al actualizar la dieta";
                        $response["code"] = 404;
                    }
                } else {
                    $response["status"] = 0;
                    $response["message"] = "La dieta no existe";
                    $response["code"] = 404;
                }
            } else {
                $response["status"] = 0;
                $response["message"] = "El usuario no existe";
                $response["code"] = 404;
            }
        } catch (\Exception $e) {
            $response["status"] = 2;
            $response["message"] = "Por favor, rellena todos los campos, sin repetir alimentos";
            $response["code"] = 500;
        }

        return response()->json($response);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dieta = Dieta::find($id);

        if (!$dieta) {

            $response["status"] = 0;
            $response["message"] = "La dieta no existe";
            $response["code"] = 404;

        } else {

            $dieta->alimentos()->detach();
            $dieta->delete();

            $response["status"] = 1;
            $response["message"] = "Dieta eliminada";
            $response["code"] = 200;

        }

        return response()->json($response);

    }
}