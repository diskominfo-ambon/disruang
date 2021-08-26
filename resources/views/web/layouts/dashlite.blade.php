<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Home')</title>
  <link rel="stylesheet" href="{{ asset('vendor/dashlite-v2/css/dashlite.min.css') }}"/>
  @routes
  @yield('head')
</head>
<body class="nk-body npc-crypto bg-white has-sidebar">
  <div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main">
        <!-- sidebar @s -->
        <div class="nk-sidebar nk-sidebar-fixed" data-content="sidebarMenu">
            <div class="nk-sidebar-element nk-sidebar-head">
                <div class="nk-sidebar-brand">
                    <a href="{{ route('user.home') }}" class="logo-link nk-sidebar-logo text-brand">
                        disruang
                    </a>
                </div>
                <div class="nk-menu-trigger mr-n2">
                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                </div>
            </div><!-- .nk-sidebar-element -->
            <div class="nk-sidebar-element">
                <div class="nk-sidebar-body" data-simplebar>
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-widget d-none d-xl-block">
                            <div class="user-account-info between-center">
                                <div class="user-account-main">
                                    <h6 class="overline-title-alt">Selamat datang kembali</h6>
                                    <div class="user-balance">{{ str(auth()->user()->name)->title()->limit(20) }}</div>
                                    <div class="user-balance-alt">
                                      {{ str(auth()->user()->getRoleNames()->first())->upper() }}
                                    </div>
                                </div>
                                <a href="#" class="btn btn-white btn-icon btn-light"><em class="icon ni ni-user-fill"></em></a>
                            </div>
                            <ul class="user-account-data gy-1">
                                <li>
                                    <div class="user-account-label">
                                        <span class="sub-text">Jumlah kegiatan</span>
                                    </div>
                                    <div class="user-account-value">
                                        <span class="lead-text">2000</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="user-account-label">
                                        <span class="sub-text">Jumlah pemohonan</span>
                                    </div>
                                    <div class="user-account-value">
                                        <span class="lead-text">0.005400</span>
                                    </div>
                                </li>
                            </ul>
                            <div class="user-account-actions">
                              <a href="{{ route('user.schedules.new') }}" class="btn btn-lg btn-primary"><span>Buat pemohonan ruangan</span></a>
                            </div>
                        </div><!-- .nk-sidebar-widget -->
                        <div class="nk-sidebar-widget nk-sidebar-widget-full d-xl-none pt-0">
                            <a class="nk-profile-toggle toggle-expand" data-target="sidebarProfile" href="#">
                                <div class="user-card-wrap">
                                    <div class="user-card">
                                        <div class="user-avatar">
                                            <span>AB</span>
                                        </div>
                                        <div class="user-info">
                                            <span class="lead-text">{{ str(auth()->user()->name)->title()->limit(20) }}</span>
                                            <span class="sub-text">{{ str(auth()->user()->email)->lower()->limit(40) }}</span>
                                        </div>
                                        <div class="user-action">
                                            <em class="icon ni ni-chevron-down"></em>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="nk-profile-content toggle-expand-content" data-content="sidebarProfile">
                                <ul class="link-list">
                                    <li><a href="#"><em class="icon ni ni-user-alt"></em><span>Ubah profil</span></a></li>
                                </ul>
                                <ul class="link-list">
                                    <li>
                                      <form method="POST" action="{{ route('auth.logout.store') }}">
                                        @csrf
                                        <button class="btn w-full px-0 btn-block"><em class="icon ni ni-signout"></em><span>Keluar</span></button>
                                      </form>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .nk-sidebar-widget -->
                        <div class="nk-sidebar-menu">
                            <!-- Menu -->
                            <ul class="nk-menu">
                                <li class="nk-menu-heading">
                                    <h6 class="overline-title">Menu</h6>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('user.home') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                                        <span class="nk-menu-text">Beranda</span>
                                    </a>
                                </li>

                                <li class="nk-menu-item">
                                    <a href="{{ route('user.submissions') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-repeat"></em></span>
                                        <span class="nk-menu-text">Permohonan</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="#" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-chat-circle"></em></span>
                                        <span class="nk-menu-text">Feedback kepuasan</span>
                                    </a>
                                </li>

                            </ul><!-- .nk-menu -->
                        </div><!-- .nk-sidebar-menu -->

                        <div class="nk-sidebar-footer">
                            <ul class="nk-menu nk-menu-footer">
                                <li class="nk-menu-item">
                                    <a href="#" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-help-alt"></em></span>
                                        <span class="nk-menu-text">Butuh bantuan?</span>
                                    </a>
                                </li>
                            </ul><!-- .nk-footer-menu -->
                        </div><!-- .nk-sidebar-footer -->
                    </div><!-- .nk-sidebar-content -->
                </div><!-- .nk-sidebar-body -->
            </div><!-- .nk-sidebar-element -->
        </div>
        <!-- end sidebar @e -->

        <!-- wrap @s -->
        <div class="nk-wrap">
            <!-- main header @s -->
            <div class="nk-header-fluid nk-header-fixed is-light">
                <div class="container-fluid">
                    <div class="nk-header-wrap">
                        <div class="nk-menu-trigger d-xl-none ml-n1">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                        </div>
                        <div class="nk-header-brand d-xl-none">
                            <a href="html/crypto/index.html" class="logo-link text-brand-sm">
                                diruang
                            </a>
                        </div>
                        <div class="nk-header-tools">
                            <ul class="nk-quick-nav">
                                <li class="dropdown user-dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <div class="user-toggle">
                                            <div class="user-avatar sm">
                                                <em class="icon ni ni-user-fill"></em>
                                            </div>
                                            <div class="user-info d-none d-md-block">
                                                <div class="user-status user-status-unverified">Akun</div>
                                                <div class="user-name dropdown-indicator">Pengguna</div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                                        <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                            <div class="user-card">
                                                <div class="user-avatar">
                                                  <em class="icon ni ni-user-fill"></em>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text">{{ str(auth()->user()->name)->title()->limit(20) }}</span>
                                                    <span class="sub-text">{{ str(auth()->user()->email)->lower()->limit(40) }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li><a href="html/crypto/profile.html"><em class="icon ni ni-user-fill"></em><span>Ubah profil</span></a></li>
                                                <li><a class="dark-switch" href="#"><em class="icon ni ni-moon-fill"></em><span>Dark Mode</span></a></li>
                                            </ul>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li>
                                                  <form method="POST" action="{{ route('auth.logout.store') }}">
                                                    @csrf
                                                    <button class="btn w-full px-0 fw-normal btn-block"><em class="icon ni ni-signout"></em><span>Keluar</span></button>
                                                  </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main header @e -->

            <!-- content @s -->
            <div class="nk-content nk-content-fluid">
                <div class="container-xl wide-lg">
                    <div class="nk-content-body">
                      @if (session('message'))
                        <div class="alert alert-fill alert-icon alert-primary alert-dismissible fade show">
                          <em class="icon ni ni-alert-circle"></em>
                          {{ session('message') }}
                        </div>
                      @endif

                       <!-- blade content -->
                        @yield('content')
                       <!-- end -->
                    </div>
                </div>
            </div>
            <!-- content @e -->
            <!-- footer @s -->
            <div class="nk-footer nk-footer-fluid">
                <div class="container-fluid">
                    <div class="nk-footer-wrap">
                        <div class="nk-footer-copyright">
                          &copy; 2021 <span class="text-primary">disruang</span> dibuat dengan penuh 💖 dari teman-teman dan untuk teman-teman.
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer @e -->
        </div>
        <!-- wrap @e -->
    </div>
    <!-- main @e -->
  </div>


  <script src="{{ asset('vendor/dashlite-v2/js/bundle.js') }}"></script>
  <script src="{{ asset('vendor/dashlite-v2/js/scripts.js') }}"></script>
  @yield('script')
</body>
</html>

