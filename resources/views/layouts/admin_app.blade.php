<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">


<!-- Mirrored from themesbrand.com/velzon/html/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 07 Jan 2023 05:00:06 GMT -->
<head>

    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('adminAsset')}}/images/favicon.ico">
    <!-- jsvectormap css -->
    <link href="{{asset('adminAsset')}}/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />

    <!--Swiper slider css-->
    <link href="{{asset('adminAsset')}}/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{asset('adminAsset')}}/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset('adminAsset')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('adminAsset')}}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('adminAsset')}}/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{asset('adminAsset')}}/css/custom.min.css" rel="stylesheet" type="text/css" />

    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <!-- Sweetalert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>

<!-- Begin page -->
<div id="layout-wrapper">

    @include('admin.elements.header')

    <!-- removeNotificationModal -->
    <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- ========== App Menu ========== -->

        @include('admin.elements.left_sidebar')

    <!-- Left Sidebar End -->
    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        @yield('content')
        <!-- End Page-content -->

        @include('admin.elements.footer')
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->



<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>
<!--end back-to-top-->

<!--preloader-->
@include('admin.elements.preloader')

<!-- Theme Settings -->
@include('admin.elements.theme_setting')

<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Sweetalert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>

<!-- JAVASCRIPT -->
<script src="{{asset('adminAsset')}}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('adminAsset')}}/libs/simplebar/simplebar.min.js"></script>
<script src="{{asset('adminAsset')}}/libs/node-waves/waves.min.js"></script>
<script src="{{asset('adminAsset')}}/libs/feather-icons/feather.min.js"></script>
<script src="{{asset('adminAsset')}}/js/pages/plugins/lord-icon-2.1.0.js"></script>
<script src="{{asset('adminAsset')}}/js/plugins.js"></script>

<!-- apexcharts -->
<script src="{{asset('adminAsset')}}/libs/apexcharts/apexcharts.min.js"></script>

<!-- Vector map-->
<script src="{{asset('adminAsset')}}/libs/jsvectormap/js/jsvectormap.min.js"></script>
<script src="{{asset('adminAsset')}}/libs/jsvectormap/maps/world-merc.js"></script>

<!--Swiper slider js-->
<script src="{{asset('adminAsset')}}/libs/swiper/swiper-bundle.min.js"></script>

<!-- Dashboard init -->
<script src="{{asset('adminAsset')}}/js/pages/dashboard-ecommerce.init.js"></script>

<!-- prismjs plugin -->
<script src="{{asset('adminAsset')}}/libs/prismjs/prism.js"></script>
<script src="{{asset('adminAsset')}}/libs/list.js/list.min.js"></script>
<script src="{{asset('adminAsset')}}/libs/list.pagination.js/list.pagination.min.js"></script>

<!-- listjs init -->
<script src="{{asset('adminAsset')}}/js/pages/listjs.init.js"></script>


<!-- App js -->
<script src="{{asset('adminAsset')}}/js/app.js"></script>

</body>


<!-- Mirrored from themesbrand.com/velzon/html/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 07 Jan 2023 05:01:28 GMT -->
</html>
