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

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card card-body">
                <form action="{{ route('account.authenticate') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" name="email"
                            placeholder="Masukkan alamat email" value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input type="password" class="form-control" id="inputPassword" name="password"
                            placeholder="Masukkan password" required>
                    </div>
                    <button type="submit" class="w-100 btn btn-primary mt-3">Masuk</button>
                </form>

                <div>
                    <p class="text-center mt-4 mb-0">Belum punya akun? <a href="{{ route('account.register') }}">Daftar</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
