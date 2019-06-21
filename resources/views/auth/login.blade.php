<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="UTF-8">
  <title>@lang('auth.login') - {{ config('other.title') }}</title>
  @section('meta')
  <meta name="description"
        content="@lang('auth.login-now-on') {{ config('other.title') }} . @lang('auth.not-a-member')">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta property="og:title" content="{{ config('other.title') }}">
  <meta property="og:type" content="website">
  <meta property="og:image" content="{{ url('/img/rlm.png') }}">
  <meta property="og:url" content="{{ url('/') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @show
  <link rel="shortcut icon" href="{{ url('/favicon.ico') }}" type="image/x-icon">
  <link rel="icon" href="{{ url('/favicon.ico') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ mix('css/main/login.css') }}" integrity="{{ Sri::hash('css/main/login.css') }}" crossorigin="anonymous">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="{{ Sri::hash('css/main/login.css') }}" crossorigin="anonymous">
</head>

<body class="bg-default" style="background: url({{ url('/img/login-background.png') }}) no-repeat center center fixed;">
  <div class="main-content">

    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('login') }}">
                <img src="{{ url('/img/login-logo.png') }}" class="navbar-brand-img" alt="{{ config('other.title') }}">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">

          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="{{ route('login') }}">
                  <img src="{{ url('/img/login-logo.png') }}">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>

          <!-- Navbar items -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="{{ route('login') }}">
                <i class="fa fa-user"></i>
                <span class="nav-link-inner--text">@lang('auth.login')</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="{{ route('registrationForm', ['code' => 'null']) }}">
                <i class="fa fa-link"></i>
                <span class="nav-link-inner--text">@lang('auth.signup')</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="{{ route('application.create') }}">
                <i class="fa fa-list"></i>
                <span class="nav-link-inner--text">Application</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
    </div>
    
    <!-- Page content -->
    <div class="container mt--8 pb-5">
  <div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
      <div class="card bg-secondary shadow border-0">
        <div class="card-body px-lg-5 py-lg-5">
          <div class="text-center text-muted mb-4">
            Sign In With Your Credentials
          </div>
          <form role="form" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group mb-3 focused">
              <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-user"></i></span>
                </div>
                <input class="form-control" placeholder="@lang('auth.username')" type="text" name="username" id="username" required="">
                @if ($errors->has('username'))
                  <br>
                  <span class="help-block text-red">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                @endif
              </div>
            </div>

            <div class="form-group focused">
              <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-lock"></i></span>
                </div>
                <input class="form-control" placeholder="@lang('auth.password')" type="password" name="password" id="password" required="">
                @if ($errors->has('password'))
                  <br>
                  <span class="help-block text-red">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                @endif
              </div>
            </div>

            @if (config('captcha.enabled') == true)
              <div class="text-center">
                <div class="form-group mb-3 focused">
                    <div class="g-recaptcha" data-sitekey="{{ config('captcha.sitekey') }}"></div>
                    @if ($errors->has('g-recaptcha-response'))
                      <span class="invalid-feedback" style="display: block;">
                          <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                      </span>
                    @endif
                </div>
              </div>
            @endif

            <div class="custom-control custom-control-alternative custom-checkbox">
              <input class="custom-control-input" id="customCheckLogin" type="checkbox" ame="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="custom-control-label" for="customCheckLogin">
                <span class="text-muted">@lang('auth.remember-me')</span>
              </label>
            </div>

            <div class="text-center">
              <button type="submit" id="login-button" class="btn btn-primary my-4">@lang('auth.login')</button>
            </div>

          </form>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-6">
          <a href="{{ route('password.request') }}" class="text-light">@lang('auth.lost-password')</a>
        </div>
        <div class="col-6 text-right">
          <a href="{{ route('username.request') }}" class="text-light">@lang('auth.lost-username')</a>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script type="text/javascript" src="{{ mix('js/app.js') }}" integrity="{{ Sri::hash('js/app.js') }}" crossorigin="anonymous"></script>
  @if (config('captcha.enabled') == true)
    <script type="text/javascript" src="https://www.google.com/recaptcha/api.js"></script>
  @endif
  @foreach (['warning', 'success', 'info'] as $key)
    @if (Session::has($key))
      <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
        });

        Toast.fire({
          type: '{{ $key }}',
          title: '{{ Session::get($key) }}'
        })
      </script>
    @endif
  @endforeach

  @if (Session::has('errors'))
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
      Swal.fire({
        title: '<strong>Validation Error</strong>',
        type: 'error',
        html: '{{ Session::get('errors') }}',
        showCloseButton: true,
      })
    </script>
  @endif

</body>  
</html>

