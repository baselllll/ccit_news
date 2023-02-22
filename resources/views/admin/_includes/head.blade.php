<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('dashboard/src/assets/img/favicon.ico')}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('styles')
    <link href="{{ asset('dashboard/layouts/vertical-light-menu/css/light/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('dashboard/layouts/vertical-light-menu/loader.js')}}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('dashboard/src/bootstrap/css/bootstrap.rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/layouts/vertical-light-menu/css/light/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('dashboard/src/plugins/src/font-icons/fontawesome/css/regular.css')}}">
    <link rel="stylesheet" href="{{ asset('dashboard/src/plugins/src/font-icons/fontawesome/css/fontawesome.css')}}">
    <link href="{{ asset('dashboard/src/plugins/src/animate/animate.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/src/assets/css/light/components/modal.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <style>
        .dataTables_paginate {
            padding: 11px;
        }
        .dataTables_paginate input {
            width: 100px;
        }
    </style>
    @stack('css')
</head>

