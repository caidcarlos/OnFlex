<?php

use App\Http\Livewire\AmigoEnVia;
use App\Http\Livewire\Beneficiarios;
use App\Http\Livewire\Camiones;
use App\Http\Livewire\Ciudades;
use App\Http\Livewire\Comerciales;
use App\Http\Livewire\CompletarPerfil;
use App\Http\Livewire\Marcas;
use App\Http\Livewire\MensajeFinal;
use App\Http\Livewire\MisPagos;
use App\Http\Livewire\Modelos;
use App\Http\Livewire\Nutricionista;
use App\Http\Livewire\PagoPlan;
use App\Http\Livewire\PagosManuales;
use App\Http\Livewire\PlanesPago;
use App\Http\Livewire\PropuestasViajes;
use App\Http\Livewire\RevisionesPagos;
use App\Http\Livewire\SubirCamiones;
use App\Http\Livewire\SubirFotoPerfil;
use App\Http\Livewire\TiposCamion;
use App\Http\Livewire\Usuarios;
use App\Http\Livewire\Viajes;
use App\Http\Middleware\ProfileReview;
use App\Http\Middleware\ProtectDashboard;
use App\Http\Controllers\PagoValidacion;
use Illuminate\Support\Facades\Route;

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
    return view('auth/login');
});

Route::middleware(['auth:sanctum', 'verified', ProfileReview::class])->get('/perfil-usuario', Usuarios::class)->name('perfil-usuario');//
Route::middleware(['auth:sanctum', 'verified'])->get('/planes-pago', PlanesPago::class)->name('planes-pago');//
Route::middleware(['auth:sanctum', 'verified'])->get('/ciudades', Ciudades::class)->name('ciudades');//
Route::middleware(['auth:sanctum', 'verified'])->get('/comerciales', Comerciales::class)->name('comerciales');//
Route::middleware(['auth:sanctum', 'verified'])->get('/marcas', Marcas::class)->name('marcas');//
Route::middleware(['auth:sanctum', 'verified'])->get('/tipos-camion', TiposCamion::class)->name('tipos-camion');//
Route::middleware(['auth:sanctum', 'verified'])->get('/modelos', Modelos::class)->name('modelos');//
Route::middleware(['auth:sanctum', 'verified', ProfileReview::class])->get('/beneficiario', Beneficiarios::class)->name('beneficiario');
Route::middleware(['auth:sanctum', 'verified', ProfileReview::class])->get('/camiones', Camiones::class)->name('camiones');//
Route::middleware(['auth:sanctum', 'verified'])->get('/propuestas-viajes', PropuestasViajes::class)->name('propuestas-viajes')->middleware(ProfileReview::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/viajes', Viajes::class)->name('viajes')->middleware(ProfileReview::class);//
Route::middleware(['auth:sanctum', 'verified'])->get('/completar-perfil', CompletarPerfil::class)->name('completar-perfil');//
Route::middleware(['auth:sanctum', 'verified'])->get('/subir-foto-perfil', SubirFotoPerfil::class)->name('subir-foto-perfil');//
Route::middleware(['auth:sanctum', 'verified'])->get('/subir-camiones', SubirCamiones::class)->name('subir-camiones');//
Route::middleware(['auth:sanctum', 'verified'])->get('/mensaje-final', MensajeFinal::class)->name('mensaje-final');//
Route::middleware(['auth:sanctum', 'verified'])->get('/pago-plan', PagoPlan::class)->name('pago-plan');//
Route::middleware(['auth:sanctum', 'verified'])->get('/pagos-manuales', PagosManuales::class)->name('pagos-manuales');//
Route::middleware(['auth:sanctum', 'verified'])->get('/revisiones-pagos', RevisionesPagos::class)->name('revisiones-pagos');//
Route::middleware(['auth:sanctum', 'verified'])->get('/mis-pagos', MisPagos::class)->name('mis-pagos');//
Route::middleware(['auth:sanctum', 'verified'])->get('/amigo-en-via', AmigoEnVia::class)->name('amigo-en-via');//
Route::middleware(['auth:sanctum', 'verified'])->get('/nutricionista', Nutricionista::class)->name('nutricionista');//
Route::get('/pagos-epayco', [PagoValidacion::class, 'index'])->name('pagos-epayco');
Route::get('/response', [PagoValidacion::class, 'pagoresponse'])->name('pagos-epayco-response');
//Route::middleware(['auth:sanctum', 'verified'])->get('/pagos-validacion', PagosValidacion::class, )->name('pagos-validacion');
//Route::middleware(['auth:sanctum', 'verified'])->get('/categorias', Categorias::class)->middleware('can:categorias')->name('categorias');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ProfileReview::class,
    ProtectDashboard::class,
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
