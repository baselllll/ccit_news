<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('dashboard/src/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('dashboard/src/plugins/src/notification/snackbar/snackbar.min.js')}}"></script>
<!-- END PAGE LEVEL PLUGINS -->

@if(Session::has('success'))
    <script>
        toastr.success("{!! Session::get('success') !!}", { timeOut: 9500 });

    </script>
@endif
@if(Session::has('error'))
    <script>
        Snackbar.show({
            text: '{!! Session::get('error') !!}',
            backgroundColor: '#e7515a',
            showAction: false,
            pos: 'top-center'
        });
    </script>
@endif
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            toastr.error("{{ $error }}", { timeOut: 14000 });
        </script>
    @endforeach
@endif
