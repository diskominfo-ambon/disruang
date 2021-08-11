<nav class="navbar navbar-expand-lg navbar-light bg-transparent navbar-top">
  <div class="container">
    <a class="navbar-brand" href="#">
      disruang
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div id="navbarNavAltMarkup" class="collapse navbar-collapse">
      <div class="d-flex align-items-center justify-content-end flex-1">
        <a class="btn btn-login" href="{{ route('auth.login') }}">
          <i class="fas fa-sign-in-alt"></i>
          <span class="d-inline-block ms-2">Login</span>
        </a>

        <a class="btn d-inline-block ms-2 text-white" href="{{ route('auth.register') }}">
          Daftar
        </a>
      </div>
    </div>
  </div>
</nav>
