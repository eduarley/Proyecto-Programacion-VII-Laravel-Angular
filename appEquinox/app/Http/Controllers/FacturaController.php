<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Pedido;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

            //no existe pedido.factura_id por eso no se pueden llamar los pedidos con dicho id de factura
            //$facturas = Factura::orderBy('id', 'asc')->with(["user", "pedidos"])->get();
            $facturas = Factura::orderBy('id', 'asc')->with(["user"])->get();
            $response = $facturas;
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

        //validar
        $validator = Validator::make(
                $request->all(),
                [
                    'pedido_id' => 'required',

                ]
            );
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        try {

            $pedido = Pedido::find($request->input('pedido_id'));

            $factura = new Factura();
            $factura->fecha = Carbon::parse(Carbon::now())->format('Y-m-d');
            $factura->pedido_id = $request->input('pedido_id');
            $factura->user_id = $request->input('user_id');

            $factura->total = $pedido->total;
            //$factura->pedidos()->attach($request->input('pedido_id'));



            if ($factura->save()) {
                $pedido->estado='facturado';
                $pedido->update();
                $response = 'Factura creada!';
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
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factura $factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        //
    }
}
