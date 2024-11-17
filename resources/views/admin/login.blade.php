@extends('admin.layouts.app')

@section('content')

<div class="container w-50 pt-5">
    <div class="authentication-inner pt-3">
      <!-- Register -->
      <div class="card">
        <div class="card-body">
          <h4 class="mb-2">
            <a href="{{ route('front.home') }}">
                <img src="{{ asset('front-assets/img/logo/logo-hitam.svg') }}" alt="logo" id="teks-hitam" class="text-logo mt-1" width="100">
            </a>
          </h4>
          <p class="mb-4">Login Admin BeioN!</p>
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
            <form action="{{ route('admin.authenticate') }}" method="post" class="mb-3">
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
                  <a href="">
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
              {{-- <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember-me" />
                  <label class="form-check-label" for="remember-me">Ingat Saya</label>
                </div>
              </div> --}}
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
              </div>
            </form>
          {{-- <p class="text-center">
            <span>Belum punya akun?</span>
            <a href="{{ route('mitra.register') }}">
              <span>Daftar Jadi Mitra</span>
            </a>
          </p> --}}
        </div>
      </div>
      <!-- /Register -->
    </div>
  </div>
@endsection

{{-- <!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif
    <form method="POST" action="{{ route('admin.authenticate') }}">
        @csrf
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}">
            @if ($errors->has('email'))
                <span>{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="password">
            @if ($errors->has('password'))
                <span>{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</body>
</html> --}}
