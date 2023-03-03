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
            @can('create_admin')
                <button
                    id="createAbout"
                    class="btn btn-primary btn-rounded mb-2 me-4 _effect--ripple waves-effect waves-light float-end"><i class="far fa-plus-square"></i> @lang('dashboard.add')</button>
           @endcan
        <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item fw-bolder">@lang('dashboard.about')</li>
                    </ol>
                </nav>
            </div>
            <!-- /BREADCRUMB -->
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-8" style="padding: 23px;">
                        <table id="about" style="width:100%">
                            <thead>
                            <tr>
                                <th>@lang('dashboard.about_title')</th>
                                <th>@lang('dashboard.about_description')</th>
                                <th>@lang('dashboard.about_image')</th>
                                <th class="no-content"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($about_data as $row)
                                <tr>
                                    <td>{{$row->title}}</td>
                                    <td>{{$row->description}}</td>
                                    <td>
                                        <img width="120px" height="120px"  src="{{$row->getMedia('about_images')[0]->getUrl()}}" class="img-thumbnail" alt="...">
                                    </td>
                                    <td>
                                        <div class="action-btns">
                                            <a href="{{route('admin.about.delete',['id'=>$row->id])}}" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="@lang('dashboard.contact_delete')" data-bs-original-title="حذف">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </a>
                                            <a id="editAbout"
                                               href="#editCategoryModal"
                                               data-toggle="modal"
                                               id="editCategory"
                                               data-title="{{ $row->title }}"
                                               data-id="{{ $row->id }}"
                                               data-description="{{ $row->description }}"
                                               data-image="{{ $row->getMedia('about_images')[0]->getUrl() }}"
                                               class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="{{__('dashboard.about_edit')}}" data-bs-original-title="تعديل">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
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
        @include('admin.modals.about.create')
        @include('admin.modals.about.edit')
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('dashboard/src/plugins/src/global/vendors.min.js')}}"></script>
@endsection
@push('js')
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script>
        $(document).ready(function () {
            $('#about').DataTable({
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
    <script src="https://cdn.datatables.net/plug-ins/1.10.15/pagination/input.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('dashboard/src/assets/js/ajax/about.js')}}"></script>
@endpush
