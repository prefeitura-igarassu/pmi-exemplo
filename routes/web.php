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
Route::get ('/produtos/{produto}'         , "App\Http\Controllers\ProdutoController@get"       );
Route::post('/produtos/{produto}'         , "App\Http\Controllers\ProdutoController@alterar"   );
Route::get ('/produtos/{produto}/deletar' , "App\Http\Controllers\ProdutoController@excluir"   );
Route::post('/produtos'                   , "App\Http\Controllers\ProdutoController@inserir"   );
Route::get ('/produtos'                   , "App\Http\Controllers\ProdutoController@pesquisar" );


//// --------- -//// PRODUTOS
Route::get ('/jquery/produtos/{produto}'   , "App\Http\Controllers\JQueryProdutoController@get"       );
Route::post('/jquery/produtos/{produto}'   , "App\Http\Controllers\JQueryProdutoController@alterar"   );
Route::delete('/jquery/produtos/{produto}' , "App\Http\Controllers\JQueryProdutoController@excluir"   );
Route::post('/jquery/produtos'             , "App\Http\Controllers\JQueryProdutoController@inserir"   );
Route::get ('/jquery/produtos'             , "App\Http\Controllers\JQueryProdutoController@pesquisar" );




require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
