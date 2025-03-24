<?php

namespace App\Http\Controllers;

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
        return view( "app" , [
            "produtos" => Produto::get(),
            "inserido" => $produto
        ] );
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
        $produto->destroy();
        return $produto;
    }

    public function get( Request $request , Produto $produto )
    {
        return $produto;
    }

    public function pesquisar( Request $request )
    {
        $produtos = Produto::where( "nome" , "like" , $request->input( "nome" ) )->get();

        //where, pagination() ...
        return view( "app" , [
            "produtos" => $produtos
        ] );
    }

}
