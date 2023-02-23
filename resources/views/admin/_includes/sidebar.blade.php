<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
        <div class="navbar-nav theme-brand flex-row  text-center">
            <div class="nav-logo">
                <div class="nav-item theme-logo">
                    <a href="{{ route('admin.dashboard') }}">
                        <img src="{{ asset('storage/'. $settings?->white_logo) }}" alt="logo">
                    </a>
                </div>
            </div>
            <div class="nav-item sidebar-toggle">
                <div class="btn-toggle sidebarCollapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg>
                </div>
            </div>
        </div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu @if(request()->url() == route('admin.dashboard')) active @endif">
                <a href="{{ route('admin.dashboard') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span>الرئيسية</span>
                    </div>
                </a>
            </li>

            <!--  Application pages -->
            @canany(['list_admin'])
                <li class="menu @if(in_array(request()->url() , [route('admin.admins.index'), route('admin.roles.index') ])) active @endif">
                    <a href="#admins" data-bs-toggle="collapse" @if(in_array(request()->url() , [route('admin.admins.index'), route('admin.roles.index') ])) aria-expanded="true" @else aria-expanded="false" @endif  class="dropdown-toggle collapsed">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            <span>الصغحات</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled @if(in_array(request()->url() , [route('admin.admins.index'), route('admin.roles.index') ])) show @endif" id="admins" data-bs-parent="#accordionExample">
                        @can('list_admin')
                            <li class="@if(in_array(request()->url() , [route('admin.admins.index') ])) active @endif">
                                <a href="{{ route('admin.admins.index') }}">الفئات</a>
                            </li>
                        @endcan
                        @can('list_admin')
                                <li class="@if(in_array(request()->url() , [route('admin.contact.index') ])) active @endif">
                                    <a href="{{ route('admin.contact.index') }}">اتصل بنا</a>
                                </li>
                        @endcan
                            @can('list_admin')
                                <li class="@if(in_array(request()->url() , [route('admin.about.index') ])) active @endif">
                                    <a href="{{ route('admin.about.index') }}" >ماذا عنا</a>
                                </li>
                            @endcan

                            @can('list_admin')
                                <li class="@if(in_array(request()->url() , [route('admin.roles.index') ])) active @endif">
                                    <a href="{{ route('admin.roles.index') }}" >الداعمين</a>
                                </li>
                            @endcan



                    </ul>
                </li>
            @endcan


            @canany(['list_admin','list_role'])
            <li class="menu @if(in_array(request()->url() , [route('admin.admins.index'), route('admin.roles.index') ])) active @endif">
                <a href="#admins" data-bs-toggle="collapse" @if(in_array(request()->url() , [route('admin.admins.index'), route('admin.roles.index') ])) aria-expanded="true" @else aria-expanded="false" @endif  class="dropdown-toggle collapsed">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        <span>مستخدمين النظام</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled @if(in_array(request()->url() , [route('admin.admins.index'), route('admin.roles.index') ])) show @endif" id="admins" data-bs-parent="#accordionExample">
                    @can('list_admin')
                        <li class="@if(in_array(request()->url() , [route('admin.admins.index') ])) active @endif">
                            <a href="{{ route('admin.admins.index') }}">إدارة المستخدمون</a>
                        </li>
                    @endcan
                    @can('list_role')
                        <li class="@if(in_array(request()->url() , [route('admin.roles.index') ])) active @endif">
                            <a href="{{ route('admin.roles.index') }}" >إدارة مجموعات الصلاحيات</a>
                        </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @canany(['list_settings'])
                <li class="menu @if(in_array(request()->url() , [route('admin.settings.index')])) active @endif">
                    <a href="#settings" data-bs-toggle="collapse" @if(in_array(request()->url() , [route('admin.settings.index')])) aria-expanded="true" @else aria-expanded="false" @endif  class="dropdown-toggle collapsed">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                            <span>الإعدادات العامة</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled @if(in_array(request()->url() , [route('admin.settings.index')])) show @endif" id="settings" data-bs-parent="#accordionExample">
                        @can('list_settings')
                            <li class="@if(in_array(request()->url() , [route('admin.settings.index') ])) active @endif">
                                <a href="{{ route('admin.settings.index') }}">اعدادات الموقع</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
        </ul>
    </nav>

</div>
<!--  END SIDEBAR  -->
