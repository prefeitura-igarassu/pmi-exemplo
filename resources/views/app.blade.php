<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  @class(['dark' => ($appearance ?? 'system') == 'dark'])>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello Bulma!</title>
    <link rel="stylesheet" href="/css/bulma.min.css">
  </head>
  <body>
  <section class="section">
    <div class="container">
        <h1 class="title">Produtos</h1>
    </div>

    @if ( isset( $inserido ) )
        <div class="notification is-primary">
            Você inseriu com sucesso o <b>Produto Nº {{ $inserido->id }} - {{ $inserido->nome }}</b>
        </div>
    @endif

    <form method="GET" action="/produtos">
        <div class="field is-grouped py-6">
            <p class="control is-expanded">
              <input class="input" type="text" placeholder="Nome ou categoria" name="global">
            </p>
            <p class="control">
              <button class="button is-info">
                Pesquisar
              </button>
            </p>
          </div>
    </form>

    <form method="POST" action="/produtos">
        @csrf

        <table class="table is-fullwidth">
            <thead>
            <tr>
                <th>Produto Nº</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Valor R$</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
                @if ( !isset( $produtos ) || count( $produtos ) == 0 )
                    <tr>
                        <td colspan="4" class="has-text-centered is-fullwidth">
                            <div class="p-4">Nenhum produto encontrado!</div>
                        </td>
                    </tr>
                @else
                    @foreach ( $produtos as $produto )
                        <tr>
                            <td>{{ $produto->id }}</td>
                            <td>{{ $produto->nome }}</td>
                            <td>{{ $produto->categoria }}</td>
                            <td class="has-text-right valor">R$ {{ dinheiro( $produto->valor ) }}</td>          <!-- formatar o valor depois -->
                        </tr> 
                    @endforeach
                @endif
            </tbody>

            <tfoot>
                <td></td>
                <td>
                    <input class="input" type="text" placeholder="Nome" name="nome" />
                </td>
                <td>
                    <input class="input" type="text" placeholder="Categoria" name="categoria" />
                </td>
                <td>
                    <input class="input has-text-right" type="text" placeholder="Valor R$" name="valor" id="valor" />
                </td>
                <td>
                    <button type=submit class="button is-primary">Salvar</button>
                </td>
            </tfoot>
        </table>
    </form>

  </section>
  </body>

    <script src="/js/vanilla-masker.min.js"></script>                   <!-- carregou a biblioteca -->
    <script>
        VMasker( document.querySelector( "#valor" )    ).maskMoney();   // uso a biblioteca carregada (formata um input)
    </script>
</html>

@php

function dinheiro( $valor )
{
    return number_format($valor, 2, ',', '.');
}

@endphp