@php

$titulo = "Produto Nº {$produto->id}";

$menu = [
  [ "url" => "/"         , "nome" => "Admin"    ],
  [ "url" => "/produtos" , "nome" => "Produtos" ],
  [ "url" => null        , "nome" => $titulo    ],
];

function dinheiro( $valor )
{
    return number_format($valor, 2, ',', '.');
}
@endphp
<x-body :titulo="$titulo" :menu="$menu" >
  <section class="section is-main-section">
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-ballot"></i></span>
            Produto Nº {{ $produto->id }}
            </p>
        </header>
  
        <div class="card-content">
            <form method="get">
                @csrf
  
                <x-input campo="Nome">
                    <input class="input" type="text" placeholder="Nome do produto" name="nome" value="{{ $produto->nome }}">
                </x-input>
  
                <x-input campo="Categoria">
                    <input class="input" type="text" placeholder="Categoria do produto" name="categoria" value="{{ $produto->categoria }}">
                </x-input>
  
                <x-input campo="Valor R$">
                    <input class="input" type="text" placeholder="Valor do produto" name="valor" id="valor" value="{{ number_format( $produto->valor , 2 ) }}">
                </x-input>
  
                <hr>
  
                <div class="field is-horizontal">
                    <div class="field-label">
                    <!-- Left empty for spacing -->
                    </div>
  
                    <div class="field-body">
                        <div class="field">
                            <div class="field is-grouped">
                                <div class="control">
                                    <button type="submit" class="button is-primary">Submit</button>
                                </div>
  
                                <div class="control">
                                    <a href="/produtos" class="button is-primary is-outlined">Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </section>
  
  
  <script src="/js/vanilla-masker.min.js"></script>                   <!-- carregou a biblioteca -->
  <script>
      VMasker( document.querySelector( "#valor" )    ).maskMoney();   // uso a biblioteca carregada (formata um input)
  </script>
</x-body>