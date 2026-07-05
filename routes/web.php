<?php


use App\Livewire\Aluno\Create;
use App\Livewire\ListaEspera\Show;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Login as AdminLogin;
use App\Livewire\Aluno\Create as AlunoCreate;
use App\Livewire\Aluno\Edit as AlunoEdit;
use App\Livewire\Aluno\Show as AlunoShow;
use App\Livewire\Mapa;
use App\Livewire\Site\SchoolSearch;
use App\Livewire\Vagas\Index as VagasIndex;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

/*
|--------------------------------------------------------------------------
| Área dos pais (pública, mobile-first)
|--------------------------------------------------------------------------
*/

Route::get('/mapa', fn () => 'Mapa interativo em construção.')->name('site.map');
Route::get("/mapa1", Mapa::class)->name("mapa");
Route::get("/aluno", Create::class)->name("aluno");
Route::get("/lista", Show::class)->name("lista");

/*
|--------------------------------------------------------------------------
| Área administrativa (desktop, navegação simulada — sem autenticação real)
|--------------------------------------------------------------------------
*/
Route::get('/', SchoolSearch::class)->name('site.search');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('/vagas', VagasIndex::class)->name('vagas.index');
    Route::get('/listas', VagasIndex::class)->name('listas');
    Route::prefix('alunos')->name('alunos.')->group(function () {
        Route::get('/', AlunoShow::class)->name('index');
        Route::get('/novo', AlunoCreate::class)->name('create');
        Route::get('/{aluno}/editar', AlunoEdit::class)->name('edit');
    });
});
