@extends('front.layouts.app')

@section('content')

  <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="p-3 w-50 pt-5">
            <div class="right-box">
                <header class="section-header pt-5">
                    <p>Welcome User</p>
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
                  <form action="{{ route ('account.authenticate') }}" method="post">
                    @csrf
                    <div class="row align-items-center">
                      <div class="form-group mb-2">
                          <label class="form-label" for="email"><small>Email</small></label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}">
                            @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                      </div>
                      <div class="form-group mb-2">
                        <div class="form-password-toggle">
                          <label class="form-label" for="password"><small>Password</small></label>
                          <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password">
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
                                <button type="submit" class="btn btn-lg btn-primary w-100 fs-6" value="Login">Login</button>
                            </div>
                            <div class="input-group mb-3">
                                <button class="btn btn-lg btn-light w-100 fs-6"><img src="assets/img/icon/google.png" style="width:20px" class="me-2"><small>Sign In with Google</small></button>
                            </div>
                            <div class="row">
                                <small>Belum punya akun? <a href="{{ route('account.register') }}" style="text-decoration: none;">Daftar Disini</a></small>
                            </div>
                        </div>
                  </form>
                </div>
            </div>
        </div>

@endsection