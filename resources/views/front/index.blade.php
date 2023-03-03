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
                                <li class="menu-item-has-children"><a href="#about_container">@lang('front.menu_about')</a></li>
                                <li class="menu-item-has-children"><a href="#container_contact">@lang('front.menu_contact')</a></li>
                                <li class="menu-item-has-children megamenu-wrapper"><a href="{{route('front.category')}}">@lang('front.menu_category')</a>
                                    <ul class="megamenu-sub-menu">
                                        <li class="megamenu-item">

                                            <!-- Start Verticle Nav  -->
                                            <div class="axil-vertical-nav">
                                                <ul class="vertical-nav-menu">
                                                    @foreach($category as $item)
                                                        <li class="vertical-nav-item active">
                                                            <a class="hover-flip-item-wrapper" href="tab{{$item->id}}}">
                                                                <span class="hover-flip-item">
                                                                <span data-text="{{$item->type}}">{{$item->type}}}</span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </div>
                                            <!-- Start Verticle Nav  -->

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
                                                                                <h5 class="title"><a href="">{{$item->title}}</a></h5>
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

    <!-- Start Mobile Menu Area  -->
    <div class="popup-mobilemenu-area">
        <div class="inner">
            <div class="mobile-menu-top">
                <div class="logo">
                    <a href="index.html">
                        <img class="dark-logo" src="assets/images/logo/logo-black.png" alt="Logo Images">
                        <img class="light-logo" src="assets/images/logo/logo-white2.png" alt="Logo Images">
                    </a>
                </div>
                <div class="mobile-close">
                    <div class="icon">
                        <i class="fal fa-times"></i>
                    </div>
                </div>
            </div>
            <ul class="mainmenu">
                <li class="menu-item-has-children"><a href="#">Home</a>
                    <ul class="axil-submenu">
                        <li><a href="index.html">Home Default</a></li>
                        <li><a href="home-creative-blog.html">Home Creative Blog</a></li>
                        <li><a href="home-seo-blog.html">Home Seo Blog</a></li>
                        <li><a href="home-tech-blog.html">Home Tech Blog</a></li>
                        <li><a href="home-lifestyle-blog.html">Home Lifestyle Blog</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children"><a href="#">Categories</a>
                    <ul class="axil-submenu">
                        <li><a href="">Accessibility</a></li>
                        <li><a href="">Android Dev</a></li>
                        <li><a href="">Accessibility</a></li>
                        <li><a href="">Android Dev</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children"><a href="#">Post Format</a>
                    <ul class="axil-submenu">
                        <li><a href="post-format-standard.html">Post Format Standard</a></li>
                        <li><a href="post-format-video.html">Post Format Video</a></li>
                        <li><a href="post-format-gallery.html">Post Format Gallery</a></li>
                        <li><a href="post-format-text.html">Post Format Text Only</a></li>
                        <li><a href="post-layout-1.html">Post Layout One</a></li>
                        <li><a href="post-layout-2.html">Post Layout Two</a></li>
                        <li><a href="post-layout-3.html">Post Layout Three</a></li>
                        <li><a href="post-layout-4.html">Post Layout Four</a></li>
                        <li><a href="post-layout-5.html">Post Layout Five</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children"><a href="#">Pages</a>
                    <ul class="axil-submenu">
                        <li><a href="post-list.html">Post List</a></li>
                        <li><a href="archive.html">Post Archive</a></li>
                        <li><a href="author.html">Author Page</a></li>
                        <li><a href="about.html">About Page</a></li>
                        <li><a href="maintenance.html">Maintenance</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                    </ul>
                </li>
                <li><a href="404.html">404 Page</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>
            <div class="buy-now-btn">
                <a href="#">Buy Now <span class="badge">$15</span></a>
            </div>
        </div>
    </div>
    <!-- End Mobile Menu Area  -->



    <!-- Start Banner Area -->
    <h1 class="d-none">Home Default Blog</h1>
    <div class="slider-area bg-color-grey">
        <div class="axil-slide slider-style-1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="slider-activation axil-slick-arrow">
                            <!-- Start Single Slide  -->
                            @foreach($categories as $item)
                                <div class="content-block">
                                    <!-- Start Post Thumbnail  -->
                                    <div class="post-thumbnail">
                                        <a href="">
                                            <img src="{{$item->getMedia('category_images')[0]->getUrl()}}" alt="Post Images">
                                        </a>
                                    </div>
                                    <!-- End Post Thumbnail  -->
                                    <!-- Start Post Content  -->
                                    <div class="post-content">
                                        <div class="post-cat">
                                            <div class="post-cat-list">
                                                <a class="hover-flip-item-wrapper" href="#">
                                                    <span class="hover-flip-item">
                                                        <span data-text="{{$item->type}}">{{$item->type}}</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                        <h2 class="title">{{$item->title}}</h2>

                                        <!-- Post Meta  -->
                                        <div class="post-meta-wrapper with-button">
                                            <div class="post-meta">
                                                <div class="post-author-avatar border-rounded">
                                                    <img src="assets/images/post-images/author/author-image-1.png" alt="Author Images">
                                                </div>
                                                <div class="content">
                                                    <h6 class="post-author-name">
                                                        <a class="hover-flip-item-wrapper" href="author.html">
                                                            <span class="hover-flip-item">
                                                                <span data-text="الادمن">الادمن</span>
                                                            </span>
                                                        </a>

                                                    </h6>
                                                    <ul class="post-meta-list">
                                                        <li>{{\Carbon\Carbon::parse($item->created_at)->format('M d Y')}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Post Content  -->
                                </div>
                            @endforeach

                            <!-- End Single Slide  -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Banner Area -->

    <!-- Start Featured Area  -->
    <div class="axil-featured-post axil-section-gap bg-color-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2 class="title">اخر الاخبار</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Start Single Post  -->
                @foreach($categories as $item)
                    <div class="col-lg-6 col-xl-6 col-md-12 col-12 mt--30">
                        <div class="content-block content-direction-column axil-control is-active post-horizontal thumb-border-rounded">
                            <div class="post-content">
                                <div class="post-cat">
                                    <div class="post-cat-list">
                                        <a class="hover-flip-item-wrapper" href="#">
                                            <span class="hover-flip-item">
                                                <span data-text="{{$item->type}}">{{$item->type}}</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <h4 class="title"><a href="">{{$item->title}}</a></h4>
                                <div class="post-meta">

                                    <div class="content">
                                        <h6 class="post-author-name">
                                            <a class="hover-flip-item-wrapper" href="author.html">
                                                <span class="hover-flip-item">
                                                    <span data-text="الادمن">الادمن</span>
                                                </span>
                                            </a>
                                        </h6>
                                        <ul class="post-meta-list">
                                            <li>{{\Carbon\Carbon::parse($item->created_at)->format('M d Y')}}</li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="post-thumbnail">
                                <a href="">
                                    <img src="{{$item->getMedia('category_images')[0]->getUrl()}}" alt="Post Images">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- End Single Post  -->
            </div>
        </div>
    </div>

    <div class="axil-trending-post-area axil-section-gap bg-color-white" style="margin-right: 700px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2 class="title">جميع الاخبار</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">

                    <div class="tab-content">
                        @foreach($all_categories_data as $key=>$item)
                            <!-- Single Tab Content  -->
                                <div class="row trend-tab-content tab-pane fade show active" id="trendone"  >
                                    <div class="col-lg-8">
                                        <!-- Start Single Post  -->
                                        <div class="content-block trend-post post-order-list axil-control">
                                            <div class="post-inner">
                                                <div class="post-content">
                                                    <div class="post-cat">
                                                        <div class="post-cat-list">
                                                            <a class="hover-flip-item-wrapper" href="#">
                                                            <span class="hover-flip-item">
                                                                <span data-text="{{$item->type}}">{{$item->type}}</span>
                                                            </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <h3 class="title"><a href="">{{$item->title}}</a></h3>
                                                    <div class="post-meta-wrapper">
                                                        <div class="post-meta">
                                                            <div class="content">
                                                                <h6 class="post-author-name">
                                                                    <a class="hover-flip-item-wrapper" href="author.html">
                                                                    <span class="hover-flip-item">
                                                                        <span data-text="الادمن">الادمن</span>
                                                                    </span>
                                                                    </a>
                                                                </h6>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="post-thumbnail">
                                                <a>
                                                    <img src="{{$item->getMedia('category_images')[0]->getUrl()}}" alt="Post Images">
                                                </a>
                                            </div>
                                        </div>
                                        <!-- End Single Post  -->
                                    </div>
                                </div>
                                <!-- Single Tab Content  -->
                        @endforeach
                    </div>
                    <!-- End Axil Tab Content  -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Trending Post Area  -->



    <!-- Start Post List Wrapper  -->
    <div class="axil-post-list-area post-listview-visible-color axil-section-gap bg-color-white">
        <div id="about_container" class="container">
            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="axil-banner">
                        <div class="thumbnail">
                            <a href="#">
                                <img class="w-100" style="height: 250px" src="{{asset('front/assets/images/logo/about.jpg')}}" alt="Banner Images">
                            </a>
                        </div>
                    </div>
                    <!-- Start Post List  -->
                    @foreach($about as $item)
                    <div class="content-block post-list-view axil-control is-active mt--30">

                            <div class="post-thumbnail">
                                <a href="">
                                    <img src="{{$item->getMedia('about_images')[0]->getUrl()}}" alt="Post Images">
                                </a>
                            </div>
                            <div class="post-content">
                                <h4 class="title"><a href="">{{$item->title}}</a></h4>
                                <div>
                                    {{$item->description}}
                                </div>
                                <div class="post-meta-wrapper">
                                    <div class="post-meta">
                                        <div class="content">
                                            <h6 class="post-author-name">
                                                <a class="hover-flip-item-wrapper" href="">
                                                    <span class="hover-flip-item">
                                                        <span data-text="الادمن">الادمن</span>
                                                    </span>
                                                </a>
                                            </h6>
                                            <ul class="post-meta-list">
                                                <li>{{\Carbon\Carbon::parse($item->created_at)->format('M d Y')}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                @endforeach
                    <!-- End Post List  -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Post List Wrapper  -->

    <!-- Start Video Area  -->
    <div class="axil-video-post-area axil-section-gap bg-color-black">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2 class="title">الفيدوهات</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($categories as $item)
                    <div class="col-xl-6 col-lg-6 col-md-12 col-md-6 col-12">
                        <!-- Start Post List  -->
                        <div class="content-block post-default image-rounded mt--30">
                            <div class="post-thumbnail">
                                <a href="">
                                    <img src="{{$item->getMedia('category_images')[0]->getUrl()}}" alt="Post Images">
                                </a>
                                <a class="video-popup position-top-center" href="{{$item->video_link}}"><span
                                        class="play-icon"></span></a>
                            </div>
                            <div class="post-content">
                                <div class="post-cat">
                                    <div class="post-cat-list">
                                        <a class="hover-flip-item-wrapper" href="#">
                                            <span class="hover-flip-item">
                                                <span data-text="{{$item->type}}">{{$item->type}}</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Post List  -->
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- End Video Area  -->

    <!-- Start Instagram Area  -->
    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2 class="title">تواصل معنا</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div id="container_contact" class="container_contact">

                        <form action="{{route('front.contact.store')}}" method="post">
                            @csrf
                            <input  required  name="name" type="name" placeholder="الاسم" >

                            <input  required name="email" type="email"  placeholder="البريد الالكترونى">

                            <input required   name="phone" type="number"  placeholder="رقم التليفون">

                            <textarea required name="description"   rows="7" placeholder="المحتوى"></textarea>

                            <input type="submit" value="ارسال">
                        </form>
                    </div>
                   <div>


                   </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Instagram Area  -->

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
