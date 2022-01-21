<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class PedidoController extends Controller
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
            //$pedidos = Pedido::with(['provincia', 'personal', 'detalleOrdenes'])->orderBy('id', "asc")->get();
            $pedidos = Pedido::with(['provincia', 'personal', 'productos'])->orderBy('id', "asc")->get();
            $response = $pedidos;
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
            $pedidos = Pedido::with(['provincia', 'personal', 'productos'])->orderBy('id', "asc")->get();
            $response = $pedidos;
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    public function alllisto()
    {
        //
        try {
            //listar
            $variable = 'Listo para facturar';
            $pedidos = Pedido::where('estado', 'Listo para facturar')->with(['provincia', 'personal', 'productos'])->orderBy('id', "asc")->get();
            $response = $pedidos;
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
        //
        $validator = Validator::make(
            $request->all(),
            [
                'cedula_cliente' => 'required',
                'nombre_completo_cliente' => 'required',
                'telefono_cliente' => 'required',
                'tipo_pedido' => 'required',
                //'fecha' => 'required',
                'direccion' => 'required',
                'provincia_id' => 'required',
                //'subtotal' => 'required',
                //'impuesto' => 'required',
                //'envio' => 'required',
                //'total' => 'required',
                //'estado' => 'required',
                //'personal_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        DB::beginTransaction();
        try {
            $pedido = new Pedido();
            $pedido->cedula_cliente = $request->input('cedula_cliente');
            $pedido->nombre_completo_cliente = $request->input('nombre_completo_cliente');
            $pedido->telefono_cliente = $request->input('telefono_cliente');
            $pedido->tipo_pedido = $request->input('tipo_pedido');
            $pedido->fecha = Carbon::parse(Carbon::now())->format('Y-m-d');
            $pedido->direccion = $request->input('direccion');
            $pedido->estado = "pendiente";
            $pedido->provincia_id = $request->input('provincia_id');
            $pedido->save();
            //Detalles
            $subtotal = 0;
            $impuesto = 0;
            $total = 0;
            $envio = 0;

            //return response()->json($request->input('detalles'), 422);




            $detalles = $request->input('detalles');
            //return response()->json($request->all(), 400);
            //return response()->json(array($detalles['idItem']), 400);

            foreach ($detalles as $item) {

                $pedido->productos()->attach($item['idItem'], [
                    'cantidad' => $item['cantidad'],
                    'total' => $item['subtotal']
                ]);
                $subtotal += $item['subtotal'];
            }



            if ($request->input('tipo_pedido') == "Express") {
                if ($request->input('provincia_id') == 1 || $request->input('provincia_id') == 2 || $request->input('provincia_id') == 3 || $request->input('provincia_id') == 4) {
                    $envio += 9000;
                } else {
                    $envio += 12000;
                }
            }


            $impuesto += $subtotal * 0.13;
            $total += $impuesto + $subtotal + $envio;
            $pedido->subtotal = $subtotal;
            $pedido->impuesto = $impuesto;
            $pedido->envio = $envio;
            $pedido->total = $total;

            $pedido->update();

            DB::commit();
            $response = "¡Pedido creado correctamente!";
            return response()->json($response, 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 422);
        }
    }


    public function updateEstado(Request $request,  $id)
    {
        //validar

        try {


            $pedido = Pedido::find($id);
            $pedido->estado = "Listo para facturar";

            if ($pedido->update()) {
                $response = 'Pedido actualizado!';
                return response()->json($response, 201);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    public function updatePersonal(Request $request,  $id)
    {
        //validar



        try {


            $pedido = Pedido::find($id);
            $pedido->personal_id = $request->input('personal_id');

            /*
            $pedido->cedula_cliente = $request->input('cedula_cliente');
            $pedido->nombre_completo_cliente = $request->input('nombre_completo_cliente');
            $pedido->telefono_cliente = $request->input('telefono_cliente');
            //tipo pedido
            $pedido->direccion = $request->input('direccion');
            */

            if ($pedido->update()) {
                $response = 'Datos actualizados!';
                return response()->json($response, 200);
            }

            $response = [
                'msg' => 'Error durante la actualización'
            ];
            return response()->json($response, 404);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            //listar
            $pedido = Pedido::where('id', $id)->with(['provincia', 'personal', 'productos'])->get()->first();
            $response = $pedido;
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
