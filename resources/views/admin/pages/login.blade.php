@extends('admin.layouts.auth')
@section('title')
    {{ env('APP_NAME') }} | Login
@endsection
@section('content')
    <div class="row">
        <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
            <a class="align-self-center">
                <img height="80px" width="150px" style="border-radius: 50px" src="{{asset("front/assets/images/logo/dashboard_icon.png")}}" alt="logo">
            </a>

            <div class="card mt-3 mb-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.authenticateAdmin') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">

                                <h3 class="text-center">تسجيل الدخول</h3>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="text" name="email" class="form-control" placeholder="@lang('dashboard.username')">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-4">
                                    <input type="password" name="password" class="form-control" placeholder="@lang('dashboard.password')">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <div class="form-check form-check-primary form-check-inline" >
                                        <label class="form-check-label" for="form-check-default" style="cursor: pointer;">
                                            <input class="form-check-input me-3" type="checkbox" id="form-check-default">
                                            تذكرني
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-4">
                                    <button class="btn btn-primary w-100">تسجيل الدخول</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
