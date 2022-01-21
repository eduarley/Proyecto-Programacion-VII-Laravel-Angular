<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Auth\Events\Failed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; //importante poner esta referencia NO aparece autocompletado
use function PHPUnit\Framework\isNull;

class ProductoController extends Controller
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
            $productos = Producto::where('estado', true)->with(['marca', 'categorias'])->orderBy('id', "asc")->get();
            $response = $productos;
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    public function all()
    {
        //
        try {
            //listar todos con estado en 0
            $productos = Producto::with(['marca', 'categorias'])->orderBy('id', "asc")->get();
            $response = $productos;
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
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|min:5',
            'descripcion' => 'required|min:10',
            'precio' => 'required|numeric',
            'estado' => 'required',
            'marca_id' => 'required',
            'categoria_id' => 'required',
            //'nombre',
            //'descripcion',
            //'precio',
            //'estado',
            //'marca_id',
        ]);
        if ($validator->fails()) {
            //return response()->json($request->all(), 422);
            return response()->json($validator->messages(), 422);
        }


        try {
            $producto = new Producto();
            $producto->nombre = $request->input('nombre');
            $producto->descripcion = $request->input('descripcion');
            $producto->precio = $request->input('precio');
            $producto->estado = $request->input('estado');
            $producto->marca_id = $request->input('marca_id');


            if ($producto->save()) {

                $categorias = $request->input('categoria_id');
                if (!is_array($request->input('categoria_id'))) {
                    //Formato array relación muchos a muchos
                    $categorias =
                        explode(',', $request->input('categoria_id'));
                }
                if (!is_null($request->input('categoria_id'))) {
                    //Agregar categorias$categorias
                    $producto->categorias()->attach($categorias);
                }
                $response = 'Producto creado!';
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
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            //listar
            $producto = Producto::where('id', $id)->with(['marca', 'categorias'])->first();
            $response = $producto;
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|min:5',
            'descripcion' => 'required|min:10',
            'precio' => 'required|numeric',
            'estado' => 'required',
            'marca_id' => 'required',
            'categoria_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }


        try {
            $producto = Producto::find($id);
            $producto->nombre = $request->input('nombre');
            $producto->descripcion = $request->input('descripcion');
            $producto->precio = $request->input('precio');
            $producto->estado = $request->input('estado');
            $producto->marca_id = $request->input('marca_id');



            /*
            if ($producto->update()) {
                if (!isNull($request->input('categoria_id'))) {
                    $producto->categorias()->sync($request->input('categoria_id'));
                }
                $response = 'Producto actualizado!';
                return response()->json($response, 201);
            } else {
                $response = [
                    'msg' => 'Error durante la actualización'
                ];
                return response()->json($response, 404);
            }
            */


            /*
            if (isNull($request->input('categoria_id'))) {
                $response = [
                    'msg' => 'Debe seleccionar al menos una categoría'
                ];

                return response()->json($response, 404);
            }
*/



            //Actualizar producto
            if ($producto->update()) {
                //Sincronice categorias
                //Array de categorias

                $categorias = $request->input('categoria_id');
                //Solo es necesario con la imagen
                if (!is_array($categorias)) {
                    //Formato array relación muchos a muchos
                    $categorias = explode(',', $request->input('categoria_id'));


                }
                if (!is_null($categorias)) {
                    //Agregar categorias

                    $producto->categorias()->sync($categorias);
                }




                $response = 'Producto actualizado!';
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
