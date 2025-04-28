<!doctype html>

<html lang="en" class="layout-menu-fixed layout-compact" data-assets-path="../assets/"
  data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>@yield('title','Page') - {{ env('APP_NAME') }}</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('backend/assets/img/favicon/favicon.ico') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/iconify-icons.css') }}" />
  <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/core.css') }}" />
  <link rel="stylesheet" href="{{ asset('backend/assets/css/demo.css') }}" />
  <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
  <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

  <!-- Page CSS -->
  <script src="{{ asset('backend/assets/vendor/js/helpers.js') }}"></script>
  <script src="{{ asset('backend/assets/js/config.js') }}"></script>
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="{{ url('/') }}" target="__blank" class="app-brand-link">
            <span class="app-brand-logo demo">
              <img class="img-fluid" src="{{ asset('frontend/assets/img/Logo.png') }}" alt="">
            </span>

          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left d-block d-xl-none align-middle"></i>
          </a>
        </div>

        <div class="menu-divider mt-0"></div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
          @include('layouts.main-menu')
        </ul>
      </aside>
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <nav
          class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
          id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
              <i class="icon-base bx bx-menu icon-md"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center me-auto">
              <div class="nav-item d-flex align-items-center">
                <span class="w-px-22 h-px-22"><i class="icon-base bx bx-search icon-md"></i></span>
                <input type="text" class="form-control border-0 shadow-none ps-1 ps-sm-2 d-md-block d-none"
                  placeholder="Search..." aria-label="Search..." />
              </div>
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-md-auto ">
              <!-- Place this tag where you want the button to render. -->
              <li class="nav-item lh-1 me-4">
                <p class="my-0 text-primary"><b>{{ auth()->user()->name }}</b></p>
                <p class="my-0 mb-0 text-end">- Admin</p>
              </li>

              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="{{ getProfileImage() }}" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar avatar-online">
                            <img src="{{ getProfileImage() }}" alt class="w-px-40 h-auto rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                          <small class="text-body-secondary">Admin</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider my-1"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <i class="icon-base bx bx-user icon-md me-3"></i><span>My Profile</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <i class="icon-base bx bx-cog icon-md me-3"></i><span>Settings</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <span class="d-flex align-items-center align-middle">
                        <i class="flex-shrink-0 icon-base bx bx-credit-card icon-md me-3"></i><span
                          class="flex-grow-1 align-middle">Billing Plan</span>
                        <span class="flex-shrink-0 badge rounded-pill bg-danger">4</span>
                      </span>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider my-1"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#"
                      onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                      <i class="icon-base bx bx-power-off icon-md me-3"></i><span>Log Out</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                      @csrf
                    </form>
                  </li>
                </ul>
              </li>
              <!--/ User -->
            </ul>
          </div>
        </nav>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">
            @yield('backend')
          </div>
          <!-- / Content -->

          <!-- Footer -->
          <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl">
              <div
                class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  &#169;
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a href="https://themeselection.com" target="_blank" class="footer-link">ThemeSelection</a>
                </div>
                <div class="d-none d-lg-inline-block">
                  <a href="https://themeselection.com/item/category/admin-templates/" target="_blank"
                    class="footer-link me-4">Admin Templates</a>

                  <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                  <a href="https://themeselection.com/item/category/bootstrap-admin-templates/" target="_blank"
                    class="footer-link me-4">Bootstrap Dashboard</a>

                  <a href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/"
                    target="_blank" class="footer-link me-4">Documentation</a>

                  <a href="https://github.com/themeselection/sneat-bootstrap-html-admin-template-free/issues"
                    target="_blank" class="footer-link">Support</a>
                </div>
              </div>
            </div>
          </footer>
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

  <script src="{{ asset('backend/assets/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/js/menu.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
  <script src="{{ asset('backend/assets/js/main.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('backend/assets/js/dashboards-analytics.js') }}"></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  @stack('scripts')
</body>

</html>