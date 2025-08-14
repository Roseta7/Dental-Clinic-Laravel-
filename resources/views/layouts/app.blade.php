<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'App File')</title>
        <!-- Boxicons , Font Awesome -->
        <link href="https://cdn.boxicons.com/fonts/basic/boxicons.min.css" rel="stylesheet" />
        <link href="https://cdn.boxicons.com/fonts/brands/boxicons-brands.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

        <!-- Bootstrap CSS  -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Sidebar Css File -->
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
        
        @stack('styles')

    </head>
    <body>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success')}}
            </div>
        @endif

        <div class= "wrapper">
            <!-- Sidebar fixed on all pages -->
            @include('layouts.sidebar')

            <!-- Changed page content -->
            <div class="main">
                @yield('content')
            </div>
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/sidebar.js') }}"></script>
        
        @stack('scripts')
    </body>
</html>