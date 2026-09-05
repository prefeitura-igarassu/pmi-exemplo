<!DOCTYPE html>
<html lang="en" class="has-aside-left has-aside-mobile-transition has-navbar-fixed-top has-aside-expanded">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - {{ $titulo }}</title>

  <!-- Bulma is included -->
  <link rel="stylesheet" href="/css/main.min.css">

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
                @foreach ( $menu as $item )
                    <li>
                        <a href="{{ $item['url'] }}" style="color: {{ $loop->last ? '#242424' : '#7a7a7a' }};">{{ $item['nome'] }}</a>
                    </li>
                @endforeach
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
                {{ $titulo }}
              </h1></div>
            </div>
            
            <div class="level-right" style="display: none;">
              <div class="level-item"></div>
            </div>
          </div>
        </div>
      </section>

    {{ $slot }}
    
    <x-footer />

    <!-- Scripts below are for demo only -->
    <script type="text/javascript" src="/js/main.min.js"></script>

    <!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
  </body>
</html>