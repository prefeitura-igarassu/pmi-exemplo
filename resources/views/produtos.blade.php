<!DOCTYPE html>
<html lang="en" class="has-aside-left has-aside-mobile-transition has-navbar-fixed-top has-aside-expanded">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Produtos</title>

  <!-- Bulma is included -->
  <link rel="stylesheet" href="css/main.min.css">

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div id="app">
    <x-header />
    <x-menu   />
    
    <section class="section is-title-bar">
        <div class="level">
          <div class="level-left">
            <div class="level-item">
              <ul>
                <li>Admin</li>
                <li>Produtos</li>
              </ul>
            </div>
          </div>
          <div class="level-right">
            <div class="level-item">
              <div class="buttons is-right">
                <a href="https://github.com/prefeitura-igarassu/pmi-exemplo" target="_blank" class="button is-primary">
                  <span class="icon"><i class="mdi mdi-github-circle"></i></span>
                  <span>GitHub</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="hero is-hero-bar">
        <div class="hero-body">
          <div class="level">
            <div class="level-left">
              <div class="level-item"><h1 class="title">
                Produtos
              </h1></div>
            </div>
            
            <div class="level-right" style="display: none;">
              <div class="level-item"></div>
            </div>
          </div>
        </div>
      </section>

      <section class="section is-main-section">
        @if ( session( "mensagem" ) )
            <div class="notification is-info">
                <div class="level">
                <div class="level-left">
                    <div class="level-item">
                    <div>
                        <span class="icon"><i class="mdi mdi-buffer default"></i></span>
                        <b>{{ session( "mensagem" ) }}</b>
                    </div>
                    </div>
                </div>
                <div class="level-right">
                    <button type="button" class="button is-small is-white jb-notification-dismiss">Dismiss</button>
                </div>
                </div>
            </div>
        @endif

        <form method="GET" action="/produtos">
            <div class="field is-grouped py-6">
                <p class="control is-expanded">
                  <input class="input" type="text" placeholder="Nome" name="nome" value="{{ $input['nome'] ?? '' }}">
                </p>
                <p class="control">
                  <button class="button is-info">
                    Pesquisar
                  </button>
                </p>
              </div>
        </form>
        
        <div class="card has-table">
          <div class="card-content">
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
                                    <section class="section">
                                        <div class="content has-text-grey has-text-centered">
                                            <p>
                                                <span class="icon is-large"><i class="mdi mdi-emoticon-sad mdi-48px"></i></span>
                                            </p>
                                            <p>Nenhum produto encontrado!</p>
                                        </div>
                                    </section>
                                </td>
                            </tr>
                        @else
                            @foreach ( $produtos as $produto )
                                <tr>
                                    <td>{{ $produto->id }}</td>
                                    <td>{{ $produto->nome }}</td>
                                    <td>{{ $produto->categoria }}</td>
                                    <td class="has-text-right valor">R$ {{ dinheiro( $produto->valor ) }}</td>          <!-- formatar o valor depois -->
                                    <td class="buttons are-small">
                                        <a href="/produtos/{{ $produto->id }}"         class="button is-small is-primary">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>
        
                                        <a href="/produtos/{{ $produto->id }}/deletar" class="button is-small is-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
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
                            <button type=submit class="button is-primary">
                                <i class="fa-solid fa-check mr-1"></i>
                                Salvar
                            </button>
                        </td>
                    </tfoot>
                </table>
            </form>
          </div>
        </div>

        
    </section>
    
    <x-footer />

    <!-- Scripts below are for demo only -->
    <script type="text/javascript" src="/js/main.min.js"></script>

    <script src="/js/vanilla-masker.min.js"></script>                   <!-- carregou a biblioteca -->
    <script>
        VMasker( document.querySelector( "#valor" )    ).maskMoney();   // uso a biblioteca carregada (formata um input)
    </script>
    
    <!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
  </body>
</html>
@php

function dinheiro( $valor )
{
    return number_format($valor, 2, ',', '.');
}

@endphp