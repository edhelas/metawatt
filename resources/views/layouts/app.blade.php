<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ config('app.name', 'Laravel') }}
        @hasSection('title')• @yield('title')@endif
        @hasSection('subtitle')- @yield('subtitle')@endif
    </title>

    <meta property="og:title" content="{{ config('app.name', 'Laravel') }} @hasSection('title')• @yield('title')@endif @hasSection('subtitle')- @yield('subtitle')@endif"/>
    <meta name="twitter:title" content="{{ config('app.name', 'Laravel') }} @hasSection('title')• @yield('title')@endif @hasSection('subtitle')- @yield('subtitle')@endif"/>
    <meta name="description" content="Découvrez et comparez les scénarios de transition énergétique électrique"/>
    <meta property="og:type" content="article"/>
    <meta property="twitter:card" content="summary"/>
    <meta property="twitter:site" content="Metawatt"/>

    <meta property="og:image" content="/img/banner.png"/>
    <meta name="twitter:image" content="/img/banner.png"/>

    <link rel="icon" type="image/png" href="/img/bolt.png" sizes="128x128">
    <link rel="manifest" href="manifest.json" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@forevolve/bootstrap-dark@1.0.0/dist/css/bootstrap-dark.min.css" />
    <link href="{{ asset('css/style.css?3') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome/css/all.css') }}" rel="stylesheet">
</head>

<body>
    <header class="p-3">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-secondary">
                    <i class="fa-solid {{ catIcon('metawatt')}} mr-2"></i> Metawatt
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="{{route('info.discover')}}" class="nav-link px-2 text-white">Découvrir</a></li>
                    <li><a href="{{route('scenarios.index')}}" class="nav-link px-2 text-white">Scénarios</a></li>
                    <li><a href="{{route('categories.index')}}" class="nav-link px-2 text-white">Énergies</a></li>
                    <li><a href="{{route('impacts.resources.index')}}" class="nav-link px-2 text-white">Impacts</a></li>
                </ul>
            </div>
        </div>
    </header>
    <main class="@if (isset($mainclass)) {{ $mainclass }} @endif">
        <div class="container">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @hasSection('title')
                <h1>
                    @hasSection('title-icon')
                        <i @hasSection('title-icon-color') style="color: @yield('title-icon-color'); " @endif
                            class="fa-solid @yield('title-icon')"></i>
                    @endif
                    @yield('title')
                    @hasSection('subtitle')
                    <small class="text-muted">@yield('subtitle')</small>
                    @endif
                </h1>
            @endif
            @yield('content')
        </div>
    </main>
    <footer class="mt-auto text-white-50">
        <div class="container mt-3">
            <p class="text-center">Metawatt by
                <a href="https://edhelas.movim.eu" class="text-white">Timothée Jaussoin</a>
                - <a href="https://github.com/edhelas/metawatt" class="text-white">Fork me on Github</a>
            </p>
        </div>
    </footer>
</body>

</html>
