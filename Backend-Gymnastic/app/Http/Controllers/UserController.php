<?php

namespace App\Http\Controllers;

use App\Models\Alimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTExceptions;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::get();

        if ($user) {
            $response["status"] = 1;
            $response["message"] = "Usuario encontrado con éxito";
            $response["code"] = 200;
            $response["user"] = $user;
        } else {
            $response["status"] = 0;
            $response["message"] = "Usuario no encontrado";
            $response["code"] = 404;
        }

        return response()->json($response);
    }

    /**
     * Display a listing of the resource.
     */
    public function show(Request $request)
    {
        try {

            $credenciales = $request->only("email", "password");

            try {

                if (!JWTAuth::attempt($credenciales)) {

                    $response["data"] = null;
                    $response["status"] = 0;
                    $response["code"] = 401;
                    $response["mesagge"] = "Las credenciales son incorrectas";
                    return response()->json($response);
                }

            } catch (JWTException $e) {

                $response["data"] = null;
                $response["code"] = 500;
                $response["mesagge"] = "No se pudo crear el token";
                return response()->json($response);
            }

            $user = auth()->user();
            $data["token"] = auth()->claims([
                "user_id" => $user->id,
                "email" => $user->email
            ])->attempt($credenciales);

            $response["data"] = $data;
            $response["id_usuario"] = $user->id;
            $response["email"] = $user->email;
            $response["status"] = 1;
            $response["code"] = 200;
            $response["mesagge"] = "Logeado con éxito";
            return response()->json($response);

        } catch (\Exception $e) {

            $response["status"] = 2;
            $response["message"] = "Por favor, rellena todos los campos";
            $response["code"] = 500;
        }

    }

    /**
     * Display a listing of the resource.
     */
    public function indexOne($id)
    {

        $user = User::where("id", $id)->first();

        if ($user) {

            if ($user) {
                $response["status"] = 1;
                $response["message"] = "Usuario encontrado con éxito en indexOne";
                $response["code"] = 200;
                $response["user"] = $user;
            } else {
                $response["status"] = 0;
                $response["message"] = "Usuario no encontrado";
                $response["code"] = 404;
            }

            return response()->json($response);

        } else {
            $response["status"] = 0;
            $response["message"] = "Usuario no encontrado";
            $response["code"] = 404;
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = User::where("email", $request["email"])->first();

            if ($user) {
                $response["status"] = 0;
                $response["message"] = "El correo ya está en uso en la base de datos";
                $response["code"] = 409;

            } else {

                $peso = $request->peso;
                $altura = $request->altura;

                if ($peso <= 0 && $altura <= 0) {

                    $response["status"] = 2;
                    $response["message"] = "Has introducido datos númericos incorrectos";
                    $response["code"] = 200;

                } else {

                    $imc = ($peso) / (($altura / 100) * ($altura / 100));

                    $user = User::create([

                        "name" => $request->name,
                        "email" => $request->email,
                        "password" => bcrypt($request->password),
                        "telefono" => $request->telefono,
                        "edad" => $request->edad,
                        "sexo" => $request->sexo,
                        "peso" => $peso,
                        "altura" => $altura,
                        "imc" => $imc


                    ]);

                    $alimentos = [
                        ["nombre" => "Yogur de soja con 2 cucharadas de miel", "cantidad" => "2 u.", "familia" => "Lacteo", "horario_ingesta" => "Desayuno", "kcal" => " 200-220", "dia" => "Lunes"],
                        ["nombre" => "Pieza de fruta", "cantidad" => "1 u.", "familia" => "Fruta", "horario_ingesta" => "Desayuno", "kcal" => "60-80", "dia" => "Lunes"],
                        ["nombre" => "Pieza de fruta", "cantidad" => "2 u.", "familia" => "Fruta", "horario_ingesta" => "Desayuno", "kcal" => "100-120", "dia" => "Lunes"],
                        ["nombre" => "Cereal integral", "cantidad" => "60g", "familia" => "Cereal", "horario_ingesta" => "Desayuno", "kcal" => "100-150", "dia" => "Martes"],
                        ["nombre" => "Tostada integral con aceite de oliva", "cantidad" => "2 de 20g", "familia" => "Derivado cereal", "horario_ingesta" => "Desayuno", "kcal" => "80-100", "dia" => "Miercoles"],
                        ["nombre" => "Batido de soja enriquezido con caco en polvo", "cantidad" => "1 vaso", "familia" => "Derivado de leguminosas", "horario_ingesta" => "Desayuno", "kcal" => "150-200", "dia" => "Jueves"],
                        ["nombre" => "Batido de soja enriquezido con caco en polvo", "cantidad" => "1 bol", "familia" => "Derivado de leguminosas", "horario_ingesta" => "Desayuno", "kcal" => "200-300", "dia" => "Jueves"],
                        ["nombre" => "Galletas", "cantidad" => "4 u.", "familia" => "Derivado de cereal", "horario_ingesta" => "Desayuno", "kcal" => "200-400", "dia" => "Viernes"],
                        ["nombre" => "Bocadillo de seitán con aceite de oliva", "cantidad" => "1 u.", "familia" => "Otro", "horario_ingesta" => "Desayuno", "kcal" => "300-400", "dia" => "Sabado"],
                        ["nombre" => "Biscote integral", "cantidad" => "4 de 10g", "familia" => "Derivado cereal", "horario_ingesta" => "Desayuno", "kcal" => "30-40", "dia" => "Domingo"],

                        ["nombre" => "Bocadillo de seitán", "cantidad" => "1 u.", "familia" => "Otro", "horario_ingesta" => "Media mañana", "kcal" => "250-300", "dia" => "Lunes"],
                        ["nombre" => "Pan integral", "cantidad" => "80 g", "familia" => "Derivado de cereal", "horario_ingesta" => "Media mañana", "kcal" => "80-120", "dia" => "Martes"],
                        ["nombre" => "Pan integral", "cantidad" => "40 g", "familia" => "Derivado de cereal", "horario_ingesta" => "Media mañana", "kcal" => "160-240", "dia" => "Miercoles"],
                        ["nombre" => "Rebanada de pan de molde integral", "cantidad" => "2 u.", "familia" => "Derivado de cereal", "horario_ingesta" => "Media mañana", "kcal" => "70-80", "dia" => "Jueves"],
                        ["nombre" => "Rodaja de seitán", "cantidad" => "70 g", "familia" => "Otro", "horario_ingesta" => "Media mañana", "kcal" => "100-120", "dia" => "Viernes"],
                        ["nombre" => "Frutos secos", "cantidad" => "40 g", "familia" => "Frutos secos", "horario_ingesta" => "Media mañana", "kcal" => "200-250 ", "dia" => "Sabado"],
                        ["nombre" => "Tofu", "cantidad" => "50 g", "familia" => "Legumbre", "horario_ingesta" => "Media mañana", "kcal" => "140-180", "dia" => "Domingo"],



                        ["nombre" => "Pasta con verduritas salteadas", "cantidad" => "---", "familia" => "Pasta", "horario_ingesta" => "Comida", "kcal" => "250-300", "dia" => "Lunes"],
                        ["nombre" => "Hamburguesa vegetal con ensalada verde", "cantidad" => "---", "familia" => "Otro", "horario_ingesta" => "Comida", "kcal" => "250-350", "dia" => "Lunes"],
                        ["nombre" => "Guacamole", "cantidad" => "---", "familia" => "Fruta", "horario_ingesta" => "Comida", "kcal" => "120-150", "dia" => "Lunes"],
                        ["nombre" => "Pieza de fruta", "cantidad" => "1 u.", "familia" => "Fruta", "horario_ingesta" => "Comida", "kcal" => "60-80", "dia" => "Martes"],
                        ["nombre" => "Pieza de fruta", "cantidad" => "2 u.", "familia" => "Fruta", "horario_ingesta" => "Comida", "kcal" => "100-120", "dia" => "Martes"],
                        ["nombre" => "Lentejas especiadas", "cantidad" => "---", "familia" => "Legumbres", "horario_ingesta" => "Comida", "kcal" => "180-220", "dia" => "Miercoles"],
                        ["nombre" => "Falafel con ensalada de tomate", "cantidad" => "---", "familia" => "Otro", "horario_ingesta" => "Comida", "kcal" => "250-300", "dia" => "Miercoles"],
                        ["nombre" => "Ensalada de cogollos y palmitos", "cantidad" => "---", "familia" => "Otro", "horario_ingesta" => "Comida", "kcal" => "100-150", "dia" => "Jueves"],
                        ["nombre" => "Espaguetis a la boloñesa", "cantidad" => "---", "familia" => "Pasta", "horario_ingesta" => "Comida", "kcal" => "300-400", "dia" => "Jueves"],
                        ["nombre" => "Arroz integral con setas", "cantidad" => "---", "familia" => "Arroz", "horario_ingesta" => "Comida", "kcal" => "250-300", "dia" => "Viernes"],
                        ["nombre" => "Canelones de verduras", "cantidad" => "2 u.", "familia" => "Verdura", "horario_ingesta" => "Comida", "kcal" => "300-400", "dia" => "Viernes"],
                        ["nombre" => "Guisantes salteados", "cantidad" => "---", "familia" => "Verdura", "horario_ingesta" => "Comida", "kcal" => "70-80", "dia" => "Sabado"],
                        ["nombre" => "Seitán frito a la menta con patata al horno", "cantidad" => "---", "familia" => "Otro", "horario_ingesta" => "Comida", "kcal" => "300-350", "dia" => "Sabado"],
                        ["nombre" => "Parrillada de verduras", "cantidad" => "---", "familia" => "Verdura", "horario_ingesta" => "Comida", "kcal" => "150-200", "dia" => "Domingo"],
                        ["nombre" => "Paella vegetal", "cantidad" => "---", "familia" => "Verdura", "horario_ingesta" => "Comida", "kcal" => "300-350", "dia" => "Domingo"],
                        ["nombre" => "Espinacas a la catalana", "cantidad" => "---", "familia" => "Verdura", "horario_ingesta" => "Comida", "kcal" => "80-100", "dia" => "Domingo"],



                        ["nombre" => "Batido de soja enriquecido con caco en miel", "cantidad" => "1 vaso", "familia" => "Derivado de leguminosas", "horario_ingesta" => "Merienda", "kcal" => "250-300", "dia" => "Lunes"],
                        ["nombre" => "Galletas", "cantidad" => "4 u.", "familia" => "Derivado dereal", "horario_ingesta" => "Merienda", "kcal" => "200-400", "dia" => "Lunes"],
                        ["nombre" => "Yogur de soja con 2 cucharadas de miel", "cantidad" => "2 u.", "familia" => "Lacteo", "horario_ingesta" => "Merienda", "kcal" => "200-400", "dia" => "Martes"],
                        ["nombre" => "Cereal integral", "cantidad" => "30 g", "familia" => "Cereal", "horario_ingesta" => "Merienda", "kcal" => "100-120", "dia" => "Miercoles"],
                        ["nombre" => "Frutos secos", "cantidad" => "20 g", "familia" => "Frutos secos", "horario_ingesta" => "Merienda", "kcal" => "120-150", "dia" => "Miercoles"],
                        ["nombre" => "Infusión con miel", "cantidad" => "---", "familia" => "Otro", "horario_ingesta" => "Merienda", "kcal" => "20", "dia" => "Jueves"],
                        ["nombre" => "Biscote integral", "cantidad" => "4 u.", "familia" => "Derivado cereal", "horario_ingesta" => "Merienda", "kcal" => "20-25", "dia" => "Viernes"],
                        ["nombre" => "Biscote integral", "cantidad" => "3 u.", "familia" => "Derivado cereal", "horario_ingesta" => "Merienda", "kcal" => "90", "dia" => "Sabado"],
                        ["nombre" => "Pieza de fruta", "cantidad" => "1 u.", "familia" => "Fruta", "horario_ingesta" => "Merienda", "kcal" => "60-80", "dia" => "Domingo"],



                        ["nombre" => "Ensalada de tomate y nueces", "cantidad" => "---", "familia" => "Verdura", "horario_ingesta" => "Cena", "kcal" => "150-200", "dia" => "Lunes"],
                        ["nombre" => "Brocheta de tofu", "cantidad" => "---", "familia" => "Legumbre", "horario_ingesta" => "Cena", "kcal" => "100-150", "dia" => "Lunes"],
                        ["nombre" => "Pieza de fruta", "cantidad" => "1 u.", "familia" => "Fruta", "horario_ingesta" => "Cena", "kcal" => "60-80", "dia" => "Lunes"],
                        ["nombre" => "Pieza de fruta", "cantidad" => "2 u.", "familia" => "Fruta", "horario_ingesta" => "Cena", "kcal" => "120-160", "dia" => "Martes"],
                        ["nombre" => "Crema de calabacin", "cantidad" => "---", "familia" => "Verdura", "horario_ingesta" => "Cena", "kcal" => "100-150", "dia" => "Martes"],
                        ["nombre" => "Rollitos de primavera con flan de arroz", "cantidad" => "---", "familia" => "Otro", "horario_ingesta" => "Cena", "kcal" => "350-450", "dia" => "Miercoles"],
                        ["nombre" => "Vichyssoise", "cantidad" => "200 g", "familia" => "Verdura", "horario_ingesta" => "Cena", "kcal" => "150-200", "dia" => "Miercoles"],
                        ["nombre" => "Macedonia con chocolate", "cantidad" => "---", "familia" => "Otro", "horario_ingesta" => "Cena", "kcal" => "100-150", "dia" => "Jueves"],
                        ["nombre" => "Gazpacho", "cantidad" => "300 g", "familia" => "Verdura", "horario_ingesta" => "Cena", "kcal" => "100-150", "dia" => "Jueves"],
                        ["nombre" => "Gazpacho", "cantidad" => "300 g", "familia" => "Verdura", "horario_ingesta" => "Cena", "kcal" => "100-150", "dia" => "Viernes"],
                        ["nombre" => "Ensalada de arroz integral", "cantidad" => "---", "familia" => "Arroz", "horario_ingesta" => "Cena", "kcal" => "150-200", "dia" => "Viernes"],
                        ["nombre" => "Espaguetis con alcachofas", "cantidad" => "---", "familia" => "Pasta", "horario_ingesta" => "Cena", "kcal" => "180-220", "dia" => "Sabado"],
                        ["nombre" => "Croquetas de cuscús integral", "cantidad" => "---", "familia" => "Otro", "horario_ingesta" => "Cena", "kcal" => "100-150", "dia" => "Sabado"],
                        ["nombre" => "Salteado de setas", "cantidad" => "---", "familia" => "Otro", "horario_ingesta" => "Cena", "kcal" => "100-150", "dia" => "Domingo"],
                        ["nombre" => "Sopa de tomate", "cantidad" => "---", "familia" => "Verdura", "horario_ingesta" => "Cena", "kcal" => "100-150", "dia" => "Domingo"]
                    ];

                    foreach ($alimentos as $alimentoData) {
                        Alimento::create([
                            "nombre" => $alimentoData["nombre"],
                            "cantidad" => $alimentoData["cantidad"],
                            "familia" => $alimentoData["familia"],
                            "horario_ingesta" => $alimentoData["horario_ingesta"],
                            "dia" => $alimentoData["dia"],
                            "kcal" => $alimentoData["kcal"],
                            "id_usuario" => $user->id
                        ]);
                    }

                    $response["status"] = 1;
                    $response["message"] = "Usuario registrado con éxito";
                    $response["code"] = 200;
                }
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

            $user = User::find($id);

            if (!$user) {

                $response["status"] = 0;
                $response["message"] = "Usuario no encontrado";
                $response["code"] = 404;

            } else {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->telefono = $request->telefono;
                $user->sexo = $request->sexo;
                $user->edad = $request->edad;

                $peso = $request->peso;
                $altura = $request->altura;

                $user->peso = $peso;
                $user->altura = $altura;
                $user->imc = ($peso) / (($altura / 100) * ($altura / 100));

                $user->save();

                $response["status"] = 1;
                $response["message"] = "Usuario actualizado con éxito";
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
        $user = User::find($id);

        if (!$user) {

            $response["status"] = 0;
            $response["message"] = "ERROR. No se pudo dar de baja al usuario";
            $response["code"] = 404;

        } else {

            $user->delete();

            $response["status"] = 1;
            $response["message"] = "Usuario dado de baja";
            $response["code"] = 200;

        }

        return response()->json($response);
    }

    public function login(Request $request)
    {

        try {

            $credenciales = $request->only("email", "password");

            try {

                if (!JWTAuth::attempt($credenciales)) {

                    $response["data"] = null;
                    $response["status"] = 0;
                    $response["code"] = 401;
                    $response["mesagge"] = "Las credenciales son incorrectas";
                    return response()->json($response);
                }

            } catch (JWTException $e) {

                $response["data"] = null;
                $response["code"] = 500;
                $response["mesagge"] = "No se pudo crear el token";
                return response()->json($response);
            }

            $user = auth()->user();
            $data["token"] = auth()->claims([
                "user_id" => $user->id,
                "email" => $user->email
            ])->attempt($credenciales);

            $response["data"] = $data;
            $response["id_usuario"] = $user->id;
            $response["email"] = $user->email;
            $response["status"] = 1;
            $response["code"] = 200;
            $response["mesagge"] = "Logeado con éxito";
            return response()->json($response);

        } catch (\Exception $e) {

            $response["status"] = 2;
            $response["message"] = "Por favor, rellena todos los campos";
            $response["code"] = 500;
        }

    }
}