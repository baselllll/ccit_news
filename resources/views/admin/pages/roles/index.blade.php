@extends('admin.layouts.master')
@section('title')
    @lang('dashboard.roles') |{{ env('APP_NAME') }}
@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/src/plugins/src/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/src/plugins/css/light/table/datatable/dt-global_style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/src/plugins/src/tomSelect/tom-select.default.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/src/plugins/css/light/tomSelect/custom-tomSelect.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('dashboard/src/plugins/src/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('dashboard/src/plugins/src/sweetalerts2/sweetalerts2.css')}}">
@endpush
@section('content')
    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">
            <input type="hidden" id="getUrl" value="{{ route('admin.roles.getAll') }}">
            <input type="hidden" id="deleteUrl" value="{{ route('admin.roles.delete') }}">
            @can('create_role')
            <button
                id="create"
                class="btn btn-primary btn-rounded mb-2 me-4 _effect--ripple waves-effect waves-light float-end"><i class="far fa-plus-square"></i> @lang('dashboard.add')</button>
            @endcan
            <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item fw-bolder">@lang('dashboard.roles')</li>
                    </ol>
                </nav>
            </div>
            <!-- /BREADCRUMB -->
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-8">
                        <table id="roles-table" class="table dt-table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>@lang('dashboard.role')</th>
                                <th class="no-content"></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.modals.roles.create')
        @include('admin.modals.roles.edit')
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('dashboard/src/plugins/src/global/vendors.min.js')}}"></script>
@endsection
@push('js')
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('dashboard/src/plugins/src/table/datatable/datatables.js')}}"></script>
    <script src="{{ asset('dashboard/src/assets/js/custom.js')}}"></script>

    <script src="{{ asset('dashboard/src/plugins/src/notification/snackbar/snackbar.min.js')}}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->

    <script src="{{ asset('dashboard/src/assets/js/ajax/roles.js')}}"></script>
    <script src="{{ asset('dashboard/src/plugins/src/tomSelect/tom-select.base.js')}}"></script>
    <script type="text/javascript">
        new TomSelect("#permissions",{
            maxItems: 150
        });
        new TomSelect("#permissions_edit",{
            maxItems: 150
        });
    </script>
    <script src="{{ asset('dashboard/src/plugins/src/sweetalerts2/sweetalerts2.min.js')}}"></script>
@endpush
