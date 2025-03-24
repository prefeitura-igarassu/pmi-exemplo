<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




//// --------- -//// PRODUTOS
Route::get ('/produtos/{produto}'  , "App\Http\Controllers\ProdutoController@get"       );
Route::post('/produtos/{produto}'  , "App\Http\Controllers\ProdutoController@alterar"   );
Route::delete('/produtos/{produto}', "App\Http\Controllers\ProdutoController@excluir"   );
Route::post('/produtos'            , "App\Http\Controllers\ProdutoController@inserir"   );
Route::get ('/produtos'            , "App\Http\Controllers\ProdutoController@pesquisar" );





require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
