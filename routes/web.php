<?php


use App\Livewire\Aluno\Create;
use App\Livewire\Mapa;
use App\Livewire\Site\SchoolSearch;

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


<<<<<<< HEAD
/*
|--------------------------------------------------------------------------
| Rotas públicas (site dos pais)
|--------------------------------------------------------------------------
|
| "site.map" e "admin.login" ainda não têm as telas implementadas (próximas
| etapas do hackathon), mas precisam existir como rotas nomeadas porque
| x-site.topbar já referencia route('site.map') e route('admin.login').
|
*/
Route::get('/', SchoolSearch::class)->name('site.search');
=======
Route::get('/vagas', SchoolSearch::class)->name('site.search');
>>>>>>> 31cf0ad703024b558068a93e69545f8275c8753a

Route::get('/mapa', fn () => 'Mapa interativo em construção.')->name('site.map');
Route::get("/mapa1", Mapa::class)->name("mapa");
Route::get("/aluno", Create::class)->name("aluno");


Route::get('/admin/login', fn () => 'Área administrativa em construção.')->name('admin.login');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ])->group(function () {
        Route::get('/dashboard', function () {
                return view('dashboard');
            })->name('dashboard');
});
