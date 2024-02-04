 <!--begin::Sidebar-->
 <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
     data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
     <!--begin::Logo-->
     <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
         <!--begin::Logo image-->
         <a href="../../demo1/dist/index.html">
             <img alt="Logo" src="{{ asset('assets/backend') }}/media/logos/default-dark.svg"
                 class="h-25px app-sidebar-logo-default" />
             <img alt="Logo" src="{{ asset('assets/backend') }}/media/logos/default-small.svg"
                 class="h-20px app-sidebar-logo-minimize" />
         </a>
         <div id="kt_app_sidebar_toggle"
             class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
             data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
             data-kt-toggle-name="app-sidebar-minimize">
             <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                 <span class="path1"></span>
                 <span class="path2"></span>
             </i>
         </div>
         <!--end::Sidebar toggle-->
     </div>
     <!--end::Logo-->
     <!--begin::sidebar menu-->
     <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
         <!--begin::Menu wrapper-->
         <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
             <!--begin::Scroll wrapper-->
             <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true"
                 data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                 data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                 data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                 data-kt-scroll-save-state="true">
                 <!--begin::Menu-->
                 <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6"
                     id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                     <!--begin:Dashboard Menu-->
                     <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                         <!--begin:Menu link-->
                         <a href="{{ route('dashboard') }}">
                             <span
                                 class="menu-link {{ Route::getCurrentRoute()->uri() == 'dashboard' ? 'active' : '' }}">
                                 <span class="menu-icon">
                                     <i class="ki-duotone ki-element-11 fs-2">
                                         <span class="path1"></span>
                                         <span class="path2"></span>
                                         <span class="path3"></span>
                                         <span class="path4"></span>
                                     </i>
                                 </span>
                                 <span class="menu-title">Dashboards</span>
                             </span>
                         </a>
                         <!--end:Menu link-->
                     </div>
                     <!--end:Dashboard Menu-->

                     <!--begin: Users Menu -->
                     <div data-kt-menu-trigger="click"
                         class="menu-item here {{ strpos(Route::getCurrentRoute()->uri(), 'dashboard/user') === 0 ? 'show' : '' }} || {{ strpos(Route::getCurrentRoute()->uri(), 'dashboard/role') === 0 ? 'show' : '' }} || {{ strpos(Route::getCurrentRoute()->uri(), 'dashboard/permission') === 0 ? 'show' : '' }} menu-accordion">
                         <!--begin:Menu link-->
                         <span class="menu-link">
                             <span class="menu-icon">
                                 <i class="ki-duotone ki-user fs-2">
                                     <span class="path1"></span>
                                     <span class="path2"></span>
                                     <span class="path3"></span>
                                 </i>
                             </span>
                             <span class="menu-title">User Management</span>
                             <span class="menu-arrow"></span>
                         </span>
                         <!--end:Menu link-->
                         <!--begin:Menu sub-->
                         <div class="menu-sub menu-sub-accordion">
                             @can('user-list')
                                 <div class="menu-item">
                                     <a class="menu-link {{ Route::getCurrentRoute()->uri() == 'dashboard/user/list' ? 'active' : '' }}"
                                         href="{{ route('user.index') }}">
                                         <span class="menu-bullet">
                                             <span class="bullet bullet-dot"></span>
                                         </span>
                                         <span class="menu-title">Users</span>
                                     </a>
                                 </div>
                             @endcan

                             <!--begin:Menu item-->
                             <div class="menu-item">
                                 <a class="menu-link {{ strpos(Route::getCurrentRoute()->uri(), 'dashboard/role') === 0 ? 'active' : '' }}"
                                     href="{{ route('role.index') }}">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">Roles</span>
                                 </a>
                             </div>
                             <!--end:Menu item-->

                             <!--begin:Menu item-->
                             <div class="menu-item">
                                 <a class="menu-link {{ Route::getCurrentRoute()->uri() == 'dashboard/permission/list' ? 'active' : '' }}"
                                     href="{{ route('permission.index') }}">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">Permissions</span>
                                 </a>
                             </div>
                             <!--end:Menu item-->
                         </div>
                         <!--end:Menu sub-->
                     </div>
                     <!--end: Users Menu -->

                     <!--begin: Settings Menu -->
                     <div data-kt-menu-trigger="click"
                         class="menu-item here {{ strpos(Route::getCurrentRoute()->uri(), 'dashboard/setting') === 0 ? 'show' : '' }} menu-accordion">
                         <!--begin:Menu link-->
                         <span class="menu-link">
                             <span class="menu-icon">
                                 <i class="ki-duotone ki-chart fs-2">
                                     <span class="path1"></span>
                                     <span class="path2"></span>
                                 </i>
                             </span>
                             <span class="menu-title">Settings</span>
                             <span class="menu-arrow"></span>
                         </span>
                         <!--end:Menu link-->
                         <!--begin:Menu sub-->
                         <div class="menu-sub menu-sub-accordion">
                             <!--begin:Menu item-->
                             <div class="menu-item">
                                 <!--begin:Menu link-->
                                 <a class="menu-link {{ Route::getCurrentRoute()->uri() == 'dashboard/setting/general' ? 'active' : '' }}"
                                     href="{{ route('setting.general.index') }}">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">General Settings</span>
                                 </a>
                                 <!--end:Menu link-->
                             </div>
                             <!--end:Menu item-->
                             <!--begin:Menu sub-->
                             <div class="menu-item">
                                 <!--begin:Menu item-->
                                 <div class="menu-item">
                                     <!--begin:Menu link-->
                                     <a class="menu-link {{ Route::getCurrentRoute()->uri() == 'dashboard/setting/smtp' ? 'active' : '' }}"
                                         href="{{ route('setting.smtp.index') }}">
                                         <span class="menu-bullet">
                                             <span class="bullet bullet-dot"></span>
                                         </span>
                                         <span class="menu-title">SMTP Settings</span>
                                     </a>
                                     <!--end:Menu link-->
                                 </div>
                                 <!--end:Menu item-->
                             </div>
                             <!--end:Menu sub-->
                         </div>
                         <!--end:Menu sub-->
                     </div>
                     <!--end: Settings Menu -->
                 </div>
                 <!--end::Menu-->
             </div>
             <!--end::Scroll wrapper-->
         </div>
         <!--end::Menu wrapper-->
     </div>
     <!--end::sidebar menu-->
 </div>
 <!--end::Sidebar-->
