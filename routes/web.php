<?php


use App\Livewire\Aluno\Create;
use App\Livewire\ListaEspera\Show;
use App\Livewire\Mapa;
use App\Livewire\Site\SchoolSearch;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/vagas', SchoolSearch::class)->name('site.search');

Route::get('/mapa', fn () => 'Mapa interativo em construção.')->name('site.map');
Route::get("/mapa1", Mapa::class)->name("mapa");
Route::get("/aluno", Create::class)->name("aluno");
Route::get("/lista", Show::class)->name("lista");


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
