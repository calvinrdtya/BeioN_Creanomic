@extends('admin.layouts.app')

@section('content')


<div class="container w-50">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          {{-- <div class="app-brand justify-content-center">
            <a href="index.html" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">
                
              </span>
              <span class="app-brand-text demo text-body fw-bolder">Sneat</span>
            </a>
          </div> --}}
          <!-- /Logo -->
          <h4 class="mb-2">
            <a href="{{ route('front.home') }}"><img src="{{ asset('front-assets/img/logo/logo-hitam.svg') }}" alt="logo" id="teks-hitam" class="text-logo mt-1" width="100"></a>
          </h4>
          <p class="mb-4">Bergabunglah Menjadi Mitra Kami!</p>
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
            <form action="{{ route('mitra.processRegister') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                  <label for="name" class="form-label">Nama Mitra</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Masukkan Nama" autofocus value="{{ old('name') }}"/>
                  @error('name')
                      <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
              </div>
              <div class="row">
                  <div class="col-md-6">
                      <div class="mb-3">
                          <label for="email" class="form-label">Email</label>
                          <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Masukkan Email" autofocus value="{{ old('email') }}"/>
                          @error('email')
                              <p class="invalid-feedback">{{ $message }}</p>
                          @enderror
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group mb-2">
                          <label class="form-label" for="phone"><small>Nomer Telepon</small></label>
                          <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="+62" id="phone" name="phone" value="{{ old('phone') }}"/>
                          @error('phone')
                              <p class="invalid-feedback">{{ $message }}</p>
                          @enderror
                      </div>
                  </div>
              </div>
          
              <div class="row">
                  <div class="col-md-6">
                      <div class="mb-3 form-password-toggle">
                          <div class="d-flex justify-content-between">
                              <label class="form-label" for="password">Password</label>
                          </div>
                          <div class="input-group input-group-merge">
                              <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder=""/>
                              <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                              @error('password')
                                  <p class="invalid-feedback">{{ $message }}</p>
                              @enderror
                          </div>
                      </div>
                  </div>
              </div>
          
              <div class="mb-3">
                  <label for="exampleFormControlSelect1" class="form-label">Pilih Jenis Mitra</label>
                  <select class="form-select @error('jenis') is-invalid @enderror" id="exampleFormControlSelect1" name="jenis" aria-label="Default select example">
                      <option selected disabled>Pilih Jenis</option>
                      <option value="transportasi motor" {{ old('jenis') == 'transportasi motor' ? 'selected' : '' }}>Transportasi Motor</option>
                      <option value="transportasi mobil" {{ old('jenis') == 'transportasi mobil' ? 'selected' : '' }}>Transportasi Mobil</option>
                      <option value="perjalanan" {{ old('jenis') == 'perjalanan' ? 'selected' : '' }}>Perjalanan</option>
                      <option value="homestay" {{ old('jenis') == 'homestay' ? 'selected' : '' }}>Homestay</option>
                      <option value="perlengkapan" {{ old('jenis') == 'perlengkapan' ? 'selected' : '' }}>Perlengkapan</option>
                  </select>
                  @error('jenis')
                      <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
              </div>
              <div class="mb-3">
                  <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="remember-me" />
                      <label class="form-check-label" for="remember-me">Ingat Saya</label>
                  </div>
              </div>
              <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Buat Akun</button>
              </div>
          </form>
          
          <p class="text-center">
            <span>Sudah Punya Akun?</span>
            <a href="{{ route('mitra.login') }}">
              <span>Login</span>
            </a>
          </p>
        </div>
      </div>
      <!-- /Register -->
    </div>
  </div>

{{-- <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="p-3 w-50 pt-5">
        <div class="right-box">
            <header class="section-header pt-5">
                <p>Welcome User</p>
            </header>
            <form action="{{ route('mitra.processRegister') }}" method="post" name="registrationForm" id="registrationForm">
                @csrf
                <div class="row align-items-center">
                    <div class="form-group mb-2">
                        <label class="form-label" for="nama"><small>Nama</small></label>
                        <input type="text" class="form-control form-control-lg bg-light fs-6 mt-1" id="name" name="name" placeholder="">
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label" for="email"><small>Email</small></label>
                        <input type="text" class="form-control form-control-lg bg-light fs-6 mt-1" placeholder="" id="email" name="email">
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label" for="phone"><small>Nomer Telepon</small></label>
                        <input type="text" class="form-control form-control-lg bg-light fs-6 mt-1" placeholder="" id="phone" name="phone">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <div class="form-password-toggle">
                                    <label class="form-label" for="password"><small>Password</small></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="">
                                        <span class="input-group-text" id="toggle-password"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <div class="form-password-toggle">
                                    <label class="form-label" for="password"><small>Konfirmasi password</small></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="">
                                        <span class="input-group-text" id="toggle-password"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                    <div class="form-group mb-3">
                        <label for="jenis">Type</label>
                        <select class="form-control" id="jenis" name="jenis" required>
                            <option value="">Select Type</option>
                            <option value="transportasi motor">Transportasi Motor</option>
                            <option value="transportasi mobil">Transportasi Mobil</option>
                            <option value="perjalanan">Perjalanan</option>
                            <option value="homestay">Homestay</option>
                            <option value="perlengkapan">Perlengkapan</option>
                        </select>
                        @error('jenis')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <button type="submit" class="btn btn-lg btn-primary w-100 fs-6" value="Register">Daftar</button>
                    </div>
                    <div class="row">
                        <small>Sudah punya akun? <a href="{{ route('account.login') }}" style="text-decoration: none;">Login dong</a></small>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> --}}

{{-- @section('customJs')

<script type="text/javascript">
    $("#registrationForm").submit(function(event) {
        event.preventDefault();

        $("button[type='submit']").prop('disabled', true);

        $.ajax({
            url: '{{ route("mitra.processRegister") }}',
            type: 'post',
            data: $(this).serializeArray(),
            dataType: 'json',
            success: function(response) {
                $("button[type='submit']").prop('disabled', false);

                var errors = response.errors;

                if (response.status == false) {

                    if (errors.name) {
                        $("#name").siblings("p").addClass('invalid-feedback').html(errors.name);
                        $("#name").addClass('is-invalid');
                    } else {
                        $("#name").siblings("p").removeClass('invalid-feedback').html();
                        $("#name").removeClass('is-invalid');
                    }

                    if (errors.email) {
                        $("#email").siblings("p").addClass('invalid-feedback').html(errors.email);
                        $("#email").addClass('is-invalid');

                    } else {
                        $("#email").siblings("p").removeClass('invalid-feedback').html();
                        $("#email").removeClass('is-invalid');

                    }

                    if (errors.phone) {
                        $("#phone").siblings("p").addClass('invalid-feedback').html(errors.phone);
                        $("#phone").addClass('is-invalid');

                    } else {
                        $("#phone").siblings("p").removeClass('invalid-feedback').html();
                        $("#phone").removeClass('is-invalid');

                    }

                    if (errors.password) {
                        $("#password").siblings("p").addClass('invalid-feedback').html(errors.password);
                        $("#password").addClass('is-invalid');

                    } else {
                        $("#password").siblings("p").removeClass('invalid-feedback').html();
                        $("#password").removeClass('is-invalid');

                    }

                } else {

                    $("#name").siblings("p").removeClass('invalid-feedback').html('');
                    $("#name").removeClass('is-invalid');

                    $("#email").siblings("p").removeClass('invalid-feedback').html('');
                    $("#email").removeClass('is-invalid');

                    $("#phone").siblings("p").removeClass('invalid-feedback').html('');
                    $("#phone").removeClass('is-invalid');

                    $("#password").siblings("p").removeClass('invalid-feedback').html('');
                    $("#password").removeClass('is-invalid');

                    window.location.href = "{{ route('account.login') }}";
                }
            },
            error: function(jQXHR, execption) {
                console.log("Something went wrong");
            }
        });
    });
</script> --}}

@endsection