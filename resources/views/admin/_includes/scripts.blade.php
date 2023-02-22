<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
@yield('scripts')
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
<script src="{{ asset('dashboard/src/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('dashboard/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{ asset('dashboard/src/plugins/src/mousetrap/mousetrap.min.js')}}"></script>
<script src="{{ asset('dashboard/src/plugins/src/waves/waves.min.js')}}"></script>
<script src="{{ asset('dashboard/layouts/vertical-light-menu/app.js')}}"></script>
<script src="https://kit.fontawesome.com/a9545f17e8.js" crossorigin="anonymous"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->
@stack('js')

