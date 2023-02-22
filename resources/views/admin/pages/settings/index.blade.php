@extends('admin.layouts.master')
@section('title')
    الإعدادات العامة |{{ env('APP_NAME') }}
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard/src/plugins/src/filepond/FilePondPluginImagePreview.min.css')}}">
    <link href="{{ asset('dashboard/src/assets/css/light/components/tabs.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dashboard/src/assets/css/light/components/list-group.css')}}" rel="stylesheet" type="text/css">

    <link href="{{ asset('dashboard/src/assets/css/light/users/account-setting.css')}}" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('dashboard/src/plugins/src/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('dashboard/src/plugins/src/sweetalerts2/sweetalerts2.css')}}">
@endpush
@section('content')
    <div class="row layout-px-spacing">
        <div class="middle-content container-xxl p-0">
            <input type="hidden" id="updateUrl" value="{{ route('admin.settings.update') }}">
            <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item fw-bolder active">الإعدادات العامة</li>
                    </ol>
                </nav>
            </div>
            <!-- /BREADCRUMB -->

            <div class="account-settings-container layout-top-spacing">

                <div class="account-content">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <ul class="nav nav-pills" id="animateLine" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="animated-underline-home-tab" data-bs-toggle="tab" href="#animated-underline-home" role="tab" aria-controls="animated-underline-home" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> اعدادات عامة</button>
                                </li>
{{--                                <li class="nav-item" role="presentation">--}}
{{--                                    <button class="nav-link" id="animated-underline-profile-tab" data-bs-toggle="tab" href="#animated-underline-profile" role="tab" aria-controls="animated-underline-profile" aria-selected="false" tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg> SMS</button>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item" role="presentation">--}}
{{--                                    <button class="nav-link" id="animated-underline-preferences-tab" data-bs-toggle="tab" href="#animated-underline-preferences" role="tab" aria-controls="animated-underline-preferences" aria-selected="false" tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> ميسر</button>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item" role="presentation">--}}
{{--                                    <button class="nav-link" id="animated-underline-contact-tab" data-bs-toggle="tab" href="#animated-underline-contact" role="tab" aria-controls="animated-underline-contact" aria-selected="false" tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> Msegat - SMS</button>--}}
{{--                                </li>--}}
                            </ul>
                        </div>
                    </div>

                    <div class="tab-content" id="animateLineContent-4">
                        <div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel" aria-labelledby="animated-underline-home-tab">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form class="section general-info" id="editForm" class="mt-0" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="info">
                                            <div class="row">
                                                <div class="col-lg-12 mx-auto">

                                                    <div class="row">
                                                        <div class="col-md-6 mb-4">
                                                            <label>اسم المتجر</label>
                                                            <input
                                                                type="text"
                                                                name="title"
                                                                id="title"
                                                                value="{{ $settings?->title }}"
                                                                class="form-control"
                                                                style="direction: rtl"
                                                                placeholder="اسم المتجر">
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong id="title_error"></strong>
                                                            </span>
                                                        </div>

                                                        <div class="col-md-6 mb-4">
                                                            <label>الرقم الضريبي</label>
                                                            <input
                                                                type="text"
                                                                name="taxNumber"
                                                                value="{{ $settings?->taxNumber }}"
                                                                id="taxNumber"
                                                                class="form-control"
                                                                style="direction: rtl"
                                                                placeholder="الرقم الضريبي">
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong id="taxNumber_error"></strong>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary mt-2 mb-2 btn-no-effect"><i class="far fa-check-circle"></i> @lang('dashboard.saveChanges')</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="animated-underline-profile" role="tabpanel" aria-labelledby="animated-underline-profile-tab">

                        </div>

                        <div class="tab-pane fade" id="animated-underline-preferences" role="tabpanel" aria-labelledby="animated-underline-preferences-tab">
                        </div>
                        <div class="tab-pane fade" id="animated-underline-contact" role="tabpanel" aria-labelledby="animated-underline-contact-tab">
                        </div>
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
    <script src="{{ asset('dashboard/src/assets/js/custom.js')}}"></script>

    <script src="{{ asset('dashboard/src/plugins/src/notification/snackbar/snackbar.min.js')}}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->

    <script src="{{ asset('dashboard/src/assets/js/ajax/settings.js')}}"></script>

    <script src="{{ asset('dashboard/src/plugins/src/sweetalerts2/sweetalerts2.min.js')}}"></script>
@endpush
