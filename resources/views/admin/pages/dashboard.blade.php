@extends('admin.layouts.master')
@section('title')
    {{ env('APP_NAME') }} | الرئيسية
@endsection
@push('css')
    <link href="{{ asset('dashboard/src/assets/css/light/components/list-group.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dashboard/src/assets/css/light/dashboard/dash_2.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="layout-px-spacing">

        <div class="middle-content container-xxl p-0">
            @can('getDashboardStats')
                <div class="row layout-top-spacing">
                    <h1>احصائيات</h1>
                </div>
            @endcan

        </div>

    </div>
@endsection
@section('scripts')
    <script src="{{ asset('dashboard/src/plugins/src/global/vendors.min.js')}}"></script>
@endsection
@push('js')
    <script src="{{ asset('dashboard/src/plugins/src/apex/apexcharts.min.js')}}"></script>
    <script src="{{ asset('dashboard/src/assets/js/dashboard/dash_2.js')}}"></script>
@endpush
