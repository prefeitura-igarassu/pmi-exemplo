<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    
    public function inserir( Request $request )
    {
        $validos = $request->validate([
            "nome"      => [ "required" , "string" , "max:100" ],
            "categoria" => [ "nullable" , "string" , "max:50"  ],
            "valor"     => [ "required" , "string" ],
        ]);

        $validos[ "valor" ] = floatval( $validos[ "valor" ] );      // converter String para Double
        $produto = Produto::create( $validos );

        // --- retorno
        return redirect( "/produtos" )
            ->with( "mensagem" , "Você inseriu com sucesso o Produto Nº {$produto->id} - {$produto->nome}" );

        /*
        return view( "app" , [
            "produtos" => Produto::get(),
            "inserido" => $produto
        ] );
         */
    }
    
    public function alterar( Request $request , Produto $produto )
    {
        $validos = $request->validate([
            "nome"      => [ "nullable" , "string" , "max:100" ],
            "categoria" => [ "nullable" , "string" , "max:50"  ],
            "valor"     => [ "nullable" , "string" ],
        ]);

        $validos[ "valor" ] = floatval( $validos[ "valor" ] );      // converter String para Double
        $produto->update( $validos );

        return redirect( "/produtos" )
            ->with( "mensagem" , "Você alterou com sucesso o Produto Nº {$produto->id} - {$produto->nome}" );
    }

    public function excluir( Request $request , Produto $produto )
    {
        $produto->delete();

        return redirect( "/produtos" )
            ->with( "mensagem" , "Você excluiu com sucesso o Produto Nº {$produto->id} - {$produto->nome}" );
    }

    public function get( Request $request , Produto $produto )
    {
        return view( "produto" , [
            "produto" => $produto
        ] );
    }

    public function pesquisar( Request $request )
    {
        $pesquisar = Produto::
              when( $request->input( "nome" )      ,  fn ( $query , $value ) => $query->where( "nome"      , "like" , "%{$value}%" ) )
            ->when( $request->input( "categoria" ) ,  fn ( $query , $value ) => $query->where( "categoria" , "like" , "%{$value}%" ) )
            ->when( $request->input( "global" ) ,  function ( $query , $value ){
                $query->orWhere( "nome"      , "like" , "%{$value}%" )
                    ->orWhere( "categoria" , "like" , "%{$value}%" );
            })->when( $request->input( "valor_min" )  ,  fn ( $query , $value ) => $query->where( "valor" , ">=" , $value )
            )->when( $request->input( "valor_max"  )  ,  fn ( $query , $value ) => $query->where( "valor" , "<=" , $value )
            )->when( $request->input( "orderBy"    )  ,  fn ( $query , $value ) => $query->orderBy( $value , $request->input( "order" , "ASC" ) ) );

        Log::info( "[PRODUTOS] " . $pesquisar->toSql() );

        //where, pagination() ...
        return view( "produtos" , [
            "produtos" => $pesquisar->paginate( 3 ),
            "input"    => $request->input(),
        ] );
    }

}
