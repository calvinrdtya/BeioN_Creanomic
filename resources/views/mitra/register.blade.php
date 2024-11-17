@extends('front.layouts.app')

@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                <li class="breadcrumb-item">Register</li>
            </ol>
        </div>
    </div>
</section>

<section class="section-10">
    <div class="container">
        <div class="login-form">
            <form action="{{ route('mitra.processRegister') }}" method="post" enctype="multipart/form-data">
                @csrf
                <h4 class="modal-title">Register Now</h4>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nama Lengkap" id="name" name="name">
                        @error('name')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email" id="email" name="email">
                        @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">ID (+62)</span>
                        <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone">
                        @error('phone')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis">Type</label>
                        <select class="form-control" id="jenis" name="jenis" required>
                            <option value="">Select Type</option>
                            <option value="transportasi">Transportasi</option>
                            <option value="perjalanan">Perjalanan</option>
                            <option value="homestay">Homestay</option>
                            <option value="perlengkapan">Perlengkapan</option>
                        </select>
                        @error('jenis')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                        @error('password')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation">
                        @error('password_confirmation')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div> --}}
                <button type="submit" class="btn btn-dark btn-block btn-lg">Register</button>
            </form>
            <div class="text-center small">Already have an account? <a href="{{ route('mitra.login') }}">Login Now</a></div>
        </div>
    </div>
</section>
@endsection