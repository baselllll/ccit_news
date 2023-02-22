<!DOCTYPE html>
<html lang="ar">
    @include('admin._includes.auth.head')
    <body class="form">
        @include('admin._includes.loader')
        <div class="auth-container d-flex">
            <div class="container mx-auto align-self-center">
                @yield('content')
            </div>
        </div>
        @include('admin._includes.auth.scripts')
    </body>
</html>
