<!DOCTYPE html>
<html lang="en">
    @include('admin._includes.head')
    <body class="layout-boxed">
        @include('admin._includes.loader')
        @include('admin._includes.navbar')
        <!--  BEGIN MAIN CONTAINER  -->
        <div class="main-container" id="container">
            <div class="overlay"></div>
            <div class="cs-overlay"></div>
            <div class="search-overlay"></div>
            @include('admin._includes.sidebar')
            <!--  BEGIN CONTENT AREA  -->
            <div id="content" class="main-content">
                @yield('content')
                @include('admin._includes.footer')
            </div>
            <!--  END CONTENT AREA  -->
        </div>
        <!-- END MAIN CONTAINER -->
        @include('admin._includes.scripts')
    </body>
</html>
