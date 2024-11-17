@extends('mitra.layouts.app')

@section('content')
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                @include('mitra.layouts.sidebar')
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    @include('mitra.layouts.navbar')
                </nav>

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold">Permintaan Dropoff Baru</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-body">

                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif

                                        @if (session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="row justify-content-center">
                                            <div class="col-lg-4">
                                                <img src="{{ $history->image_path }}" alt="" class="img-fluid mb-4">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Invoice ID</label>
                                                    <input class="form-control" value="{{ $history->invoice_id }}"
                                                        disabled />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Nama</label>
                                                    <input class="form-control" value="{{ $history->user->name }}"
                                                        disabled />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Jenis Sampah</label>
                                                    <input class="form-control" value="{{ $history->title }}" disabled />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Berat</label>
                                                    <input class="form-control" value="{{ $history->quantity_text }}"
                                                        disabled />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Poin</label>
                                                    <input class="form-control" value="{{ $history->point_text }}"
                                                        disabled />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Status</label>
                                                    <div class="d-block">{!! $history->status_badge !!}</div>
                                                </div>
                                                <form class="d-flex mt-4"
                                                    action="{{ route('mitra.perlengkapan.dropoff.update', $history->invoice_id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')

                                                    <button type="submit" name="status" value="2"
                                                        class="flex-grow-1 btn btn-danger me-2">Tolak</button>
                                                    <button type="submit" name="status" value="1"
                                                        class="flex-grow-1 btn btn-primary ">Terima</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
