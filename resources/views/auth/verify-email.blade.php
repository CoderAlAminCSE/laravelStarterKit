<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <title>Please Verify Your Email</title>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="{{ asset('assets/backend') }}/media/logos/favicon.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('assets/backend') }}/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/backend') }}/css/style.bundle.css" rel="stylesheet" type="text/css" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Page bg image-->
        <style>
            body {
                background-image: url('{{ asset('assets/backend') }}/media/auth/bg5.jpg');
            }

            [data-bs-theme="dark"] body {
                background-image: url('{{ asset('assets/backend') }}/media/auth/bg5-dark.jpg');
            }
        </style>
        <!--end::Page bg image-->
        <!--begin::Authentication - Signup Welcome Message -->
        <div class="d-flex flex-column flex-center flex-column-fluid">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center text-center p-10">
                <!--begin::Wrapper-->
                <div class="card card-flush w-lg-650px py-5">
                    <div class="card-body py-15 py-lg-20">
                        <!--begin::Logo-->
                        <div class="mb-14">
                            <a class="">
                                <img alt="Logo" src="{{ asset('assets/backend') }}/media/logos/custom-2.svg"
                                    class="h-40px" />
                            </a>
                        </div>
                        <!--end::Logo-->
                        <!--begin::Title-->
                        <h1 class="fw-bolder text-gray-900 mb-5">Verify your email</h1>
                        <!--end::Title-->
                        <!--begin::Action-->
                        <div class="fs-6 mb-8">
                            <span class="fw-semibold text-gray-500">Did’t receive an email?</span>
                            {{-- <a href="../../demo1/dist/authentication/layouts/corporate/sign-up.html"
                                class="link-primary fw-bold">Try Again</a> --}}

                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary">{{ __('Try Again') }}</button>.
                            </form>
                        </div>
                        <!--end::Action-->
                        <!--begin::Illustration-->
                        <div class="mb-0">
                            <img src="{{ asset('assets/backend') }}/media/auth/please-verify-your-email.png"
                                class="mw-100 mh-300px theme-light-show" alt="" />
                            <img src="{{ asset('assets/backend') }}/media/auth/please-verify-your-email-dark.png"
                                class="mw-100 mh-300px theme-dark-show" alt="" />
                        </div>
                        <!--end::Illustration-->
                    </div>
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Authentication - Signup Welcome Message-->
    </div>
    <!--end::Root-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('assets/backend') }}/plugins/global/plugins.bundle.js"></script>
    <script src="{{ asset('assets/backend') }}/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
