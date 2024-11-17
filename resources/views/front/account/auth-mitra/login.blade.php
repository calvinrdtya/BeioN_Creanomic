@extends('admin.layouts.app')

@section('content')

<div class="container w-50 pt-5">
    <div class="authentication-inner pt-3">
      <!-- Register -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="index.html" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">
                
              </span>
              {{-- <span class="app-brand-text demo text-body fw-bolder">Sneat</span> --}}
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-2">
            <a href="{{ route('front.home') }}"><img src="{{ asset('front-assets/img/logo/logo-hitam.svg') }}" alt="logo" id="teks-hitam" class="text-logo mt-1" width="100"></a>
          </h4>
          <p class="mb-4">Login untuk menjadi mitra BeioN!</p>
            @if (Session::has('success'))
              <div class="alert alert-success">
                {{ Session::get('success') }}
              </div>
            @endif
            @if (Session::has('error'))
              <div class="alert alert-danger">
                {{ Session::get('error') }}
              </div>
            @endif
            <form action="{{ route('mitra.authenticate') }}" method="post" class="mb-3">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email or username" autofocus/>
                @error('email')
                  <p class="invalid-feedback">{{ $message }}</p>
                @enderror
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                  <a href="auth-forgot-password-basic.html">
                    <small>Forgot Password?</small>
                  </a>
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder=""/>
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  @error('password')
                    <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                </div>
              </div>
              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember-me" />
                  <label class="form-check-label" for="remember-me">Ingat Saya</label>
                </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
              </div>
            </form>
          <p class="text-center">
            <span>Belum punya akun?</span>
            <a href="{{ route('mitra.register') }}">
              <span>Daftar Jadi Mitra</span>
            </a>
          </p>
        </div>
      </div>
      <!-- /Register -->
    </div>
  </div>

{{-- <div class="buy-now">
  <a href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/" target="_blank" class="btn btn-danger btn-buy-now">
    Jadi Member
  </a>
</div> --}}

  {{-- <div class="container d-flex justify-content-center align-items-center min-vh-100">
    @include('mitra.message')
    <div class="p-3 w-50 pt-5">
      <div class="right-box">
        <header class="section-header pt-5">
          <p>Welcome Mitra</p>
        </header>
          @if (Session::has('success'))
            <div class="alert alert-success">
              {{ Session::get('success') }}
            </div>
          @endif
          @if (Session::has('error'))
            <div class="alert alert-danger">
              {{ Session::get('error') }}
            </div>
          @endif
          <form action="{{ route('mitra.authenticate') }}" method="post">
            @csrf
              <div class="row align-items-center">
                <div class="form-group mb-2">
                  <label class="form-label" for="email"><small>Email</small></label>
                    <input type="text" value="{{ old('email') }}" name="email" id="email" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                      <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
              <div class="form-group mb-2">
                <div class="form-password-toggle">
                  <label class="form-label" for="password"><small>Password</small></label>
                    <div class="input-group">
                      <input type="password" name="password" id="password" class="form-control  @error('password') is-invalid @enderror">
                      @error('password')
                        <p class="invalid-feedback">{{ $message }}</p>
                      @enderror
                      <span class="input-group-text" id="toggle-password"><i class="bx bx-hide"></i></span>
                    </div>
                  </div>
                </div>
                  <div class="input-group mb-4 d-flex justify-content-between">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="formCheck">
                      <label for="formCheck" class="form-check-label text-secondary"><small>Ingat Saya</small></label>
                    </div>
                    <div class="forgot">
                      <small><a href="{{ route('front.forgotPassword') }}" style="text-decoration: none;">Lupa Password?</a></small>
                    </div>
                  </div>
                    <div class="input-group mb-3">
                      <button type="submit" class="btn btn-lg btn-primary w-100 fs-6">Login</button>
                    </div>
                    <div class="input-group mb-3">
                      <button class="btn btn-lg btn-light w-100 fs-6"><img src="assets/img/icon/google.png" style="width:20px" class="me-2"><small>Sign In with Google</small></button>
                    </div>
                    <div class="row">
                      <small>Belum punya akun? <a href="{{ route('mitra.register') }}" style="text-decoration: none;">Daftar Disini</a></small>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div> --}}
@endsection