<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset("back/assets/") }}"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>@yield("title", "Jendela 360")</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset("back/assets/img/favicon/favicon.ico") }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset("back/assets/vendor/fonts/boxicons.css") }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset("back/assets/vendor/css/core.css") }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset("back/assets/vendor/css/theme-default.css") }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset("back/assets/css/demo.css") }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset("back/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css") }}" />
    <link rel="stylesheet" href="{{ asset("back/assets/vendor/libs/apex-charts/apex-charts.css") }}" />

    <!-- Page CSS -->
    @yield('external-css')

    <!-- Helpers -->
    <script src="{{ asset("back/assets/vendor/js/helpers.js") }}"></script>

    <script src="{{ asset("back/assets/js/config.js") }}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        @include("back.components.sidebar")
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          @include("back.components.navbar")
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            @yield("content")

            <!-- Footer -->
                {{-- @include("back.components.footer") --}}
            <!-- / Footer -->
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset("back/assets/vendor/libs/jquery/jquery.js") }}"></script>
    <script src="{{ asset("back/assets/vendor/libs/popper/popper.js") }}"></script>
    <script src="{{ asset("back/assets/vendor/js/bootstrap.js") }}"></script>
    <script src="{{ asset("back/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js") }}"></script>

    <script src="{{ asset("back/assets/vendor/js/menu.js") }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset("back/assets/vendor/libs/apex-charts/apexcharts.js") }}"></script>

    <!-- Main JS -->
    <script src="{{ asset("back/assets/js/main.js") }}"></script>

    <!-- Page JS -->
    <script src="{{ asset("back/assets/js/dashboards-analytics.js") }}"></script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const sessionStatus  = "{{ Session::has('status') }}"
        const sessionMessage = "{{ Session::get('status') }}"
        const sessionClass   = "{{ Session::get('alert-class') }}"

        if(sessionStatus) {
            Swal.fire(
                sessionClass == "error" ? "Opps!" : "Success!" ,
                sessionMessage,
                sessionClass
            )
        }
    </script>
    @yield('external-js')
  </body>
</html>
