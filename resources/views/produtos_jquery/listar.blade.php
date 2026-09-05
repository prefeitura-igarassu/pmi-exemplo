@php

$titulo = "Produtos";

$menu = [
  [ "url" => "/"         , "nome" => "Admin"    ],
  [ "url" => "/produtos" , "nome" => "Produtos" ],
];
@endphp
<x-body :titulo="$titulo" :menu="$menu" >
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" >

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

    <div class="card has-table">
      <div class="card-content">
          <table id="produtosTable" class="table is-fullwidth">
            <thead>
                <tr>
                    <th>Produto Nº</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Valor R$</th>
                </tr>
            </thead>

            <tbody></tbody>
        </table>
      </div>
    </div>

    
</section>
  <!-- https://gridjs.io/ -->

  <script src="/js/jquery-3.7.1.js"></script>                               <!-- carregou a biblioteca -->
  <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
  

  <script src="/js/vanilla-masker.min.js"></script>                   <!-- carregou a biblioteca -->
  <script>
    // Create our number formatter.
    const moneyFormatter = new Intl.NumberFormat('pt-BR', {
      style: 'currency',
      currency: 'BRL',
    } );

    // executa depois de toda a página ter sido carregada
    $( () => {
        $( '#produtosTable' ).DataTable({
          processing: true,
          serverSide: true,
          select: true,

          ajax: {
              url: "/jquery/produtos?json=1",
              dataSrc: {
                  data: 'data',
                  //draw: 'request',
                  recordsTotal: 'total',
                  recordsFiltered: 'total'  
              }
          },

          columns: [
              { data: "id"        },
              { data: "nome"      },
              { data: "categoria" },
              { data: "valor"     }
          ]
      });
    });

      //VMasker( document.querySelector( "#valor" )    ).maskMoney();   // uso a biblioteca carregada (formata um input)
  </script>
</x-body>