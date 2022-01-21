<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try {
            //listar
            $personals = Personal::where('estado', true)->orderBy('id', 'asc')->with(["vehiculo"])->get();
            $response = $personals;
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        //
        try {
            //listar
            $personals = Personal::orderBy('id', 'asc')->with(["vehiculo"])->get();
            $response = $personals;
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
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
        $validator = Validator::make(
            $request->all(),
            [
                'nombre' => 'required|min:3',
                'apellido' => 'required|min:3',
                'correo' => 'required|email',
                'telefono' => 'required|digits:8',
                'estado' => 'required',
                'vehiculo_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }


        try {
            $personal = new Personal();
            $personal->nombre = $request->input('nombre');
            $personal->apellido = $request->input('apellido');
            $personal->correo = $request->input('correo');
            $personal->telefono = $request->input('telefono');
            $personal->estado = $request->input('estado');
            $personal->vehiculo_id = $request->input('vehiculo_id');

            if ($personal->save()) {
                $response = 'Personal creado!';
                return response()->json($response, 201);
            } else {
                $response = [
                    'msg' => 'Error durante la creación'
                ];
                return response()->json($response, 404);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            //listar
            $personal = Personal::where('id', $id)->with(["vehiculo"])->get()->first();
            $response = $personal;
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function edit(Personal $personal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|min:3',
            'apellido' => 'required|min:3',
            'correo' => 'required|email',
            'telefono' => 'required|digits:8',
            'estado' => 'required',
            'vehiculo_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }


        try {
            $personal = Personal::find($id);
            $personal->nombre = $request->input('nombre');
            $personal->apellido = $request->input('apellido');
            $personal->correo = $request->input('correo');
            $personal->telefono = $request->input('telefono');
            $personal->estado = $request->input('estado');
            $personal->vehiculo_id = $request->input('vehiculo_id');

            if ($personal->update()) {
                $response = 'Personal actualizado!';
                return response()->json($response, 201);
            } else {
                $response = [
                    'msg' => 'Error durante la actualización'
                ];
                return response()->json($response, 404);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personal $personal)
    {
        //
    }
}
