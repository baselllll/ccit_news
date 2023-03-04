<!doctype html>
<html class="no-js" lang="en" dir="rtl">
<head>
    @include("front.layouts.linkedCss")
</head>
<body>
<div class="main-wrapper">
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>

    <!-- Start Header -->
    <header class="header axil-header  header-light header-sticky ">
        <div class="header-wrap">
            <div class="row justify-content-between align-items-center">
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-3 col-12">
                    <div class="logo">
                        <a>
                            <img class="dark-logo" src="{{$setting->getMedia('settings_images')[0]->getUrl()}}" alt="Blogar logo">
                        </a>
                    </div>
                </div>

                <div class="col-xl-6 d-none d-xl-block">
                    <div class="mainmenu-wrapper">
                        <nav class="mainmenu-nav">
                            <!-- Start Mainmanu Nav -->
                            <ul class="mainmenu">
                                <li class="menu-item-has-children"><a href="{{route('front.home')}}">@lang('front.menu_home')</a></li>
                                <li  class="menu-item-has-children megamenu-wrapper"><a href="{{route('front.category')}}">@lang('front.menu_category')</a>
                                    <ul class="megamenu-sub-menu" style="min-width:0px">
                                        <li class="megamenu-item">
                                            <!-- Start Verticle Menu  -->
                                            <div class="axil-vertical-nav-content">
                                                <!-- Start One Item  -->
                                                <div class="axil-vertical-inner tab-content" id="tab3" style="display: block;">
                                                    <div class="axil-vertical-single">
                                                        <div class="row">
                                                        @foreach($categories as $item)
                                                            <!-- Start Post List  -->
                                                                <div class="col-lg-3">
                                                                    <div class="content-block image-rounded">
                                                                        <div class="post-thumbnail mb--20">
                                                                            <a>
                                                                                <img class="img-thumbnail"  src="{{$item->getMedia('category_images')[0]->getUrl()}}" alt="Post Images">
                                                                            </a>
                                                                        </div>
                                                                        <div class="post-content">
                                                                            <div class="post-cat">
                                                                                <div class="post-cat-list">
                                                                                    <a class="hover-flip-item-wrapper" href="#">
                                                                                        <span class="hover-flip-item">
                                                            <span data-text={{$item->type}}>{{$item->type}}</span>
                                                                                        </span>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                            <h5 class="title"><a href="{{route('front.news-detail',['id'=>$item->id])}}">{{$item->title}}</a></h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- End Post List  -->
                                                            @endforeach

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End One Item  -->

                                            </div>
                                            <!-- End Verticle Menu  -->
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                            <!-- End Mainmanu Nav -->
                        </nav>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-8 col-md-8 col-sm-9 col-12">
                    <div class="header-search text-end d-flex align-items-center">
                        <form class="header-search-form d-sm-block d-none">
                            <div class="axil-search form-group">
                                <button type="submit" class="search-button"><i class="fal fa-search"></i></button>
                                <input type="text" class="form-control" placeholder="Search">
                            </div>
                        </form>
                        <div class="mobile-search-wrapper d-sm-none d-block">
                            <button class="search-button-toggle"><i class="fal fa-search"></i></button>
                            <form class="header-search-form">
                                <div class="axil-search form-group">
                                    <button type="submit" class="search-button"><i class="fal fa-search"></i></button>
                                    <input type="text" class="form-control" placeholder="Search">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Start Header -->




    <!-- Start Banner Area -->
    <div class="banner banner-single-post post-formate post-standard alignwide">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Start Single Slide  -->
                    <div class="content-block">
                        <!-- Start Post Thumbnail  -->
                        <div class="post-thumbnail">
                            <img height="200px" src="{{$category->getMedia('category_images')[0]->getUrl()}}" alt="Post Images">
                        </div>
                        <!-- End Post Thumbnail  -->
                        <!-- Start Post Content  -->
                        <div class="post-content">
                            <h1 class="title">{{$category->title}}</h1>
                        </div>
                        <!-- End Post Content  -->
                    </div>
                    <!-- End Single Slide  -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Banner Area -->

    <!-- Start Post Single Wrapper  -->
    <div class="post-single-wrapper axil-section-gap bg-color-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="axil-post-details">
                        <h1 class="has-medium-font-size">{{$category->title}}</h1>
                        <figure class="wp-block-image">
                            <p>{{\Carbon\Carbon::parse($category->created_at)->format('M d Y')}}</p>
                            <p>{{$category->type}}</p>
                        </figure>
                        <p>
                            {{$category->content}}
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Post Single Wrapper  -->

    <!-- Start Footer Area  -->
    <div class="axil-footer-area axil-footer-style-1 footer-variation-2">
        <div class="footer-mainmenu">
            <div class="container">
                <div class="row">
                </div>
            </div>
        </div>

        <!-- Start Footer Top Area  -->
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-4">
                        <div class="logo">
                            <a>
                                <img class="dark-logo" src="{{$setting->getMedia('settings_images')[0]->getUrl()}}" alt="Logo Images">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-8">
                        <!-- Start Post List  -->
                        <div class="d-flex justify-content-start mt_sm--15 justify-content-md-end align-items-center flex-wrap">
                            <ul class="social-icon color-tertiary md-size justify-content-start">
                                <li><a href="{{$setting->faceBook}}"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="{{$setting->linkedin}}"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="{{$setting->twitter}}"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="{{$setting->instagram}}"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                        <!-- End Post List  -->
                    </div>

                </div>
            </div>
        </div>
        <!-- End Footer Top Area  -->

        <!-- Start Copyright Area  -->
        <div class="copyright-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4">
                        <div class="copyright-right text-start text-md-end mt_sm--20">
                            <p class="b3">كل الحقوق محفوطه</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Copyright Area  -->
    </div>
    <!-- End Footer Area  -->

    <!-- Start Back To Top  -->
    <a id="backto-top"></a>
    <!-- End Back To Top  -->

</div>
@include("front.layouts.scripts")

</body>


</html>
