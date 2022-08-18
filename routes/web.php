<?php


use App\Http\Livewire\Iva;
use App\Http\Livewire\Caja;
use App\Http\Livewire\ListaCategoria;
use App\Http\Livewire\ListaProductos;
use App\Http\Livewire\ListaClientes;
use App\Http\Livewire\ServicioTecnico;
use App\Http\Livewire\ServicioTecnicoEditar;
use App\Http\Livewire\ListaServicioTecnico;
use App\Http\Livewire\ListaVentas;
use App\Http\Livewire\ProcesarPago;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\FacturaVentaController;
use App\Http\Controllers\ScraperController;
use App\Http\Controllers\EditarServicioController;
use App\Http\Livewire\Tasa;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return Redirect::route('login');
});



Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {


   Route::get('/scraper',[ScraperController::class, 'scraper'])->name('scraper');

   Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

   /************IVA************ */
   Route::get('/iva', Iva::class)->name('iva');

   /************CATEGORIAS************ */
   Route::get('/categorias', ListaCategoria::class)->name('categorias');
   Route::get('/categorias/nuevo', function () {return view('categorias.create');})->name('categoriasaNuevo');

   Route::controller(CategoriasController::class)->group(function(){
    Route::post('/categorias/save', 'create')->name('nuevaCategoria');
    Route::get('/categorias/{id}', 'show');
    Route::post('/categorias/editar', 'editar')->name('editarCategoria');
   });
   

    /************CLIENTES************ */
  Route::get('/clientes', ListaClientes::class)->name('clientes');
  Route::get('/clientes/nuevo', function () {return view('clientes.create');})->name('clientesNuevo');

  Route::controller(ClientesController::class)->group(function(){
    Route::post('/clientes/save', 'create')->name('nuevaclientes');
    Route::get('/clientes/{id}', 'show');
    Route::post('/clientes/editar', 'editar')->name('editarclientes');
   });


    /************PRODUCTOS************ */
   Route::get('/productos', ListaProductos::class)->name('productos');

   Route::controller(ProductosController::class)->group(function(){
    Route::get('/productos/nuevo', 'index')->name('productosN');
     Route::post('/productos/save', 'create')->name('nuevoproductos');
     Route::get('/productos/{id}', 'show');
     Route::post('/productos/editar', 'editar')->name('editarproductos');
    });

     /************SERVICIO TECNICO************ */
     Route::get('/servicioTecnico', ServicioTecnico::class)->name('servicioTecnico');
     Route::get('/listaServicioTecnico', ListaServicioTecnico::class)->name('listaServicioTecnico');
     Route::get('/servicioTecnicoEditar/{id}', ServicioTecnicoEditar::class)->name('servicioTecnicoEditar');



 /************IMPRIMIR FACTURA************ */
 Route::controller(FacturaVentaController::class)->group(function(){
  Route::post('/imprimirFactura', 'imprimirFactura')->name('imprimirFactura');
  Route::post('/imprimirReciboVenta', 'imprimirRecibo');
  });
  
     /************Ventas*************/
     Route::get('/caja', Caja::class)->name('caja');
     Route::get('/listadoVentas', ListaVentas::class)->name('listadoVentas');
     Route::get('/procesarPago', ProcesarPago::class)->name('procesarPago');
 

        /************Tasa************ */
   Route::get('/tasa', Tasa::class)->name('tasa');


    /*************Sin configurar***** */
     /************PROVEEDORES*************/
     Route::get('/proveedores', ListaProductos::class)->name('proveedores');
     Route::get('/proveedores/nuevo', function () {return view('proveedores.create');})->name('proveedoresNuevo');



});
