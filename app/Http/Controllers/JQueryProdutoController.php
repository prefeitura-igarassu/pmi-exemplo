<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Produto;

class  JQueryProdutoController extends Controller
{
    
    public function inserir( Request $request )
    {
        $validos = $request->validate([
            "nome"      => [ "required" , "string" , "max:100" ],
            "categoria" => [ "nullable" , "string" , "max:50"  ],
            "valor"     => [ "required" , "string" ],
        ]);

        return Produto::create( $validos );
    }
    
    public function alterar( Request $request , Produto $produto )
    {
        $validos = $request->validate([
            "nome"      => [ "nullable" , "string" , "max:100" ],
            "categoria" => [ "nullable" , "string" , "max:50"  ],
            "valor"     => [ "nullable" , "string" ],
        ]);

        $produto->update( $validos );
        return $produto;
    }

    public function excluir( Request $request , Produto $produto )
    {
        $produto->delete();
        return $produto;
    }

    public function get( Request $request , Produto $produto )
    {
        return $produto;
    }

    public function pesquisar( Request $request )
    {
        // se ele não espera um JSON, é porque está chamando o HTML
        if ( !$request->input( "json" , false ) ) 
        {
            return view( "produtos_jquery/listar" );
        }

        $perPage = $request->input( "perPage" , 3 );

        $pesquisar = Produto::
              when( $request->input( "nome" )      ,  fn ( $query , $value ) => $query->where( "nome"      , "like" , "%{$value}%" ) )
            ->when( $request->input( "categoria" ) ,  fn ( $query , $value ) => $query->where( "categoria" , "like" , "%{$value}%" ) )
            ->when( $request->input( "global" ) ,  function ( $query , $value ){
                $query->orWhere( "nome"      , "like" , "%{$value}%" )
                    ->orWhere( "categoria" , "like" , "%{$value}%" );
            })->when( $request->input( "valor_min" )  ,  fn ( $query , $value ) => $query->where( "valor" , ">=" , $value )
            )->when( $request->input( "valor_max"  )  ,  fn ( $query , $value ) => $query->where( "valor" , "<=" , $value )
            )->when( $request->input( "orderBy"    )  ,  fn ( $query , $value ) => $query->orderBy( $value , $request->input( "order" , "ASC" ) ) );

        return $pesquisar->paginate( $perPage );
    }

}
