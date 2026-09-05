@php

$titulo = "Produtos";

$menu = [
  [ "url" => "/"         , "nome" => "Admin"    ],
  [ "url" => "/produtos" , "nome" => "Produtos" ],
];

function dinheiro( $valor )
{
    return number_format($valor, 2, ',', '.');
}
@endphp
<x-body :titulo="$titulo" :menu="$menu" >
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

      <div class="notification">
        <div class="level">
          <div class="level-left">
            <div class="level-item">
              <div class="buttons has-addons">
                @for ( $i = 1; $i <= $produtos->lastPage(); $i++)
                    <a href="{{ $produtos->url( $i ) }}" class="button {{ $produtos->currentPage() == $i ? 'is-active' : ''}}">{{ $i }}</a>
                @endfor
              </div>

            </div>
          </div>
          <div class="level-right">
            <div class="level-item">
              <small>Página {{ $produtos->currentPage() }} de {{ $produtos->lastPage() }}</small>
            </div>
          </div>
        </div>
      </div>
    </div>

    
</section>

  <script src="/js/vanilla-masker.min.js"></script>                   <!-- carregou a biblioteca -->
  <script>
      VMasker( document.querySelector( "#valor" )    ).maskMoney();   // uso a biblioteca carregada (formata um input)
  </script>
</x-body>