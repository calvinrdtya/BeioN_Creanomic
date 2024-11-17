@extends('front.layouts.front-no-sidebar')

@section('title', $title)
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h2 class="text-center mb-4">{{ $title }}</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-body">
                <form action="{{ route('account.processRegister') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="inputName">Nama</label>
                        <input type="text" class="form-control" id="inputName" name="name" placeholder="Masukkan nama"
                            value="{{ old('name') }}" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" name="email"
                            placeholder="Masukkan alamat email" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="inputPhoneNumber">Nomor Telepon</label>
                        <input type="text" class="form-control" id="inputPhoneNumber" name="phone"
                            placeholder="Masukkan nomor telepon" value="{{ old('phone') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input type="password" class="form-control" id="inputPassword" name="password"
                            placeholder="Masukkan password" required>
                    </div>

                    <div class="form-group">
                        <label for="inputPasswordConfirmation">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="inputPasswordConfirmation"
                            name="password_confirmation" placeholder="Konfirmasi password" required>
                    </div>

                    <button type="submit" class="w-100 btn btn-primary mt-3">Masuk</button>
                </form>

                <div>
                    <p class="text-center mt-4 mb-0">Sudah punya akun? <a href="{{ route('account.login') }}">Login</a>
                </div>
            </div>
        </div>
    </div>
@endsection
