@extends('admin.layouts.master')
@section('title')
    @lang('dashboard.admins') |{{ env('APP_NAME') }}
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
        <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item fw-bolder">@lang('dashboard.contacts')</li>
                    </ol>
                </nav>
            </div>
            <!-- /BREADCRUMB -->
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-8" style="padding: 23px;">
                        <table id="contact" class="table dt-table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>@lang('dashboard.contact_name')</th>
                                <th>@lang('dashboard.contact_email')</th>
                                <th>@lang('dashboard.contact_phone')</th>
                                <th>@lang('dashboard.contact_description')</th>
                                <th class="no-content"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contact_data as $row)
                                <tr>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>{{$row->phone}}</td>
                                    <td>{{$row->description}}</td>
                                    <td>
                                        <div class="action-btns">
                                            <a href="{{route('admin.contact.delete',['id'=>$row->id])}}" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="@lang('dashboard.contact_delete')" data-bs-original-title="??????">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('dashboard/src/plugins/src/global/vendors.min.js')}}"></script>
@endsection
@push('js')
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script>
        $(document).ready(function () {
            $('#contact').DataTable({
                language: {
                    'paginate': {
                        'previous': '<span class="prev-icon"></span>',
                        'next': '<span class="next-icon"></span>'
                    }
                }
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.15/pagination/input.js"></script>
@endpush
