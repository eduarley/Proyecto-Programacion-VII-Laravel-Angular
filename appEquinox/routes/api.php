<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculoController;
use App\Models\Provincia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DetallePedidoController;
use App\Http\Controllers\PedidoController;
use App\Models\DetallePedido;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

//http://127.0.0.1:8000/api/v1/
Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'producto'], function ($router) {
        Route::get('', [ProductoController::class, 'index']);
        Route::get('/all', [ProductoController::class, 'all'])->middleware(['auth:api', 'scopes:Administrador']);
        Route::get('/{id}', [ProductoController::class, 'show']);
        Route::post('', [ProductoController::class, 'store'])->middleware(['auth:api', 'scopes:Administrador']);
        Route::patch(
            '/{id}',
            [
                ProductoController::class, 'update'
            ]
        );
    });


    Route::group(['prefix' => 'marca'], function ($router) {
        Route::get('', [MarcaController::class, 'index']);
        Route::get('/{id}', [MarcaController::class, 'show']);
    });

    Route::group(['prefix' => 'categoria'], function ($router) {
        Route::get('', [CategoriaController::class, 'index']);
        Route::get('/{id}', [CategoriaController::class, 'show']);
    });

    Route::group(['prefix' => 'provincia'], function ($router) {
        Route::get('', [ProvinciaController::class, 'index']);
        Route::get('/{id}', [ProvinciaController::class, 'show']);
    });

    Route::group(['prefix' => 'user'], function ($router) {
        Route::get('', [UserController::class, 'index'])->middleware(['auth:api']);
        Route::get('/{id}', [UserController::class, 'show'])->middleware(['auth:api', 'scopes:Administrador']);
    });

    Route::group(['prefix' => 'rol'], function ($router) {
        Route::get('', [RolController::class, 'index']);
        Route::get('/{id}', [RolController::class, 'show']);
    });

    Route::group(['prefix' => 'personal'], function ($router) {
        Route::get('', [PersonalController::class, 'index']);
        Route::get('/all', [PersonalController::class, 'all'])->middleware(['auth:api', 'scopes:Administrador']);
        Route::get('/{id}', [PersonalController::class, 'show']);
        Route::post('', [PersonalController::class, 'store'])->middleware(['auth:api', 'scopes:Administrador']);
        Route::patch(
            '/{id}',
            [
                PersonalController::class, 'update'
            ]
        )->middleware(['auth:api']);
    });

    Route::group(['prefix' => 'vehiculo'], function ($router) {
        Route::get('', [VehiculoController::class, 'index']);
        Route::get('/{id}', [VehiculoController::class, 'show']);
    });

    Route::group(['prefix' => 'pedido'], function ($router) {
        Route::get('', [PedidoController::class, 'index'])->middleware(['auth:api', 'scope:Administrador,Vendedor']);
        Route::get('/all', [PedidoController::class, 'all'])->middleware(['auth:api', 'scope:Administrador,Vendedor,Bodega']);
        Route::get('/alllisto', [PedidoController::class, 'alllisto'])->middleware(['auth:api', 'scope:Administrador,Vendedor,Bodega']);
        Route::get('/{id}', [PedidoController::class, 'show'])->middleware(['auth:api', 'scope:Administrador,Vendedor,Bodega']);
        Route::post('', [PedidoController::class, 'store'])->middleware(['auth:api', 'scope:Administrador,Vendedor']);
        Route::patch(
            '/{id}',
            [
                PedidoController::class, 'updateEstado'
            ]
        )->middleware(['auth:api', 'scope:Administrador,Vendedor,Bodega']);

        Route::patch(
            'updatePersonal/{id}',
            [
                PedidoController::class, 'updatePersonal'
            ]
        )->middleware(['auth:api', 'scope:Administrador,Vendedor,Bodega']);
    });

    Route::group(['prefix' => 'factura'], function ($router) {
        Route::get('', [FacturaController::class, 'index'])->middleware(['auth:api', 'scope:Administrador,Vendedor']);
        Route::get('/all', [FacturaController::class, 'all'])->middleware(['auth:api', 'scope:Administrador,Vendedor']);
        Route::post('', [FacturaController::class, 'store'])->middleware(['auth:api', 'scope:Vendedor']);
    });

    Route::group(['prefix' => 'detallepedido'], function ($router) {
        Route::get('/{id}', [DetallePedidoController::class, 'show'])->middleware(['auth:api', 'scope:Administrador,Vendedor']);
        Route::post('', [DetallePedidoController::class, 'store'])->middleware(['auth:api', 'scope:Administrador,Vendedor']);
    });
    //->middleware(['auth:api','scopes:administrador'])

    Route::group([
        'prefix' => 'auth'
    ], function ($router) {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
});
