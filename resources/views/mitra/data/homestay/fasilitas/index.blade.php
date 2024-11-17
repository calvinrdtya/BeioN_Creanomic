@extends('mitra.layouts.app')

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            @include('mitra.layouts.sidebar')
        </aside>
        <div class="layout-page">
            <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                @include('mitra.layouts.navbar')
            </nav>
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    @include('mitra.message')
                        <div class="card">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-header mb-0">Fasilitas</h5>
                                <div class="d-flex align-items-center">
                                    <button data-bs-toggle="modal" data-bs-target="#addFasilitas" type="button" class="btn btn-sm btn-primary me-2">
                                        <span class="bx bx-edit-alt"></span>&nbsp; Tambahkan Fasilitas
                                    </button>
                                    <div class="nav-item d-flex align-items-center">
                                        <i class="bx bx-search fs-4 lh-0 me-2"></i>
                                        <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Homestay</th>
                                            <th>Fasilitas</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @forelse($fasilitas as $index => $fasilita)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                @if($fasilita->homestay)
                                                {{ $fasilita->homestay->title }}
                                                @else
                                                {{ 'Homestay not found' }}
                                                @endif
                                            </td>
                                            <td>
                                                @foreach(explode(', ', $fasilita->title) as $facility)
                                                <span class="badge bg-primary">{{ $facility }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <button data-bs-toggle="modal" data-bs-target="#editfasilitas{{ $fasilita->id }}" type="button" class="btn btn-sm btn-outline-primary me-2">
                                                        <span class="bx bx-edit-alt"></span>&nbsp; Edit
                                                    </button>
                                                    <form id="delete-form-{{ $fasilita->id }}" action="{{ route('mitra.homestay.destroy', $fasilita->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            <span class="bx bx-trash"></span>&nbsp;Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4">Records Not Found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- Add Fasilitas Modal -->
            <!-- Modal untuk menambah fasilitas -->
                <div class="modal fade" id="addFasilitas" tabindex="-1" aria-labelledby="addFasilitasModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addFasilitasModalLabel">Tambah Fasilitas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('mitra.fasilitas.store') }}" method="POST">
                                    @csrf
                                    <div class="my-2">
                                        <label for="homestay_id" class="form-label">Kamar</label>
                                        <select class="form-select" name="homestay_id" id="homestay_id" required>
                                            <option value="" disabled selected>Pilih Kamar</option>
                                            @foreach($homestays as $homestay)
                                                <option value="{{ $homestay->id }}">{{ $homestay->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="my-2">
                                        <label class="form-label">Fasilitas</label><br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="checkbox" name="fasilitas[]" value="wifi" class="form-check-input" id="fasilitas_wifi">
                                                    <label class="form-check-label" for="fasilitas_wifi">Wifi</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="checkbox" name="fasilitas[]" value="ac" class="form-check-input" id="fasilitas_ac">
                                                    <label class="form-check-label" for="fasilitas_ac">AC</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="checkbox" name="fasilitas[]" value="dapur" class="form-check-input" id="fasilitas_dapur">
                                                    <label class="form-check-label" for="fasilitas_dapur">Dapur</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="checkbox" name="fasilitas[]" value="parkir" class="form-check-input" id="fasilitas_parkir">
                                                    <label class="form-check-label" for="fasilitas_parkir">Parkir Mobil</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="checkbox" name="fasilitas[]" value="tv" class="form-check-input" id="fasilitas_tv">
                                                    <label class="form-check-label" for="fasilitas_tv">TV</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="checkbox" name="fasilitas[]" value="receptionist" class="form-check-input" id="fasilitas_receptionist">
                                                    <label class="form-check-label" for="fasilitas_receptionist">Receptionist</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="checkbox" name="fasilitas[]" value="24" class="form-check-input" id="fasilitas_24">
                                                    <label class="form-check-label" for="fasilitas_24">24/7 Check In</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="checkbox" name="fasilitas[]" value="cctv" class="form-check-input" id="fasilitas_cctv">
                                                    <label class="form-check-label" for="fasilitas_cctv">CCTV</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="checkbox" name="fasilitas[]" value="card" class="form-check-input" id="fasilitas_card">
                                                    <label class="form-check-label" for="fasilitas_card">Card Payment</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="checkbox" name="fasilitas[]" value="housekeeping" class="form-check-input" id="fasilitas_housekeeping">
                                                    <label class="form-check-label" for="fasilitas_housekeeping">Daily Housekeeping</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-perjalanan my-2">
                                        <label for="fasilitas_tambahan" class="float-start mb-2 title-booking-three">Fasilitas Tambahan<span class="text-danger">*</span></label>
                                        <textarea class="form-control nav-group-mvp" id="fasilitas_tambahan" name="fasilitas_tambahan" rows="2" placeholder="" required></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            <!-- Edit Fasilitas Modal -->
            @foreach ($fasilitas as $fasilita)
                <div class="modal fade" id="editfasilitas{{ $fasilita->id }}" tabindex="-1" aria-labelledby="editfasilitasLabel{{ $fasilita->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editfasilitasLabel{{ $fasilita->id }}">Edit Fasilitas Homestay</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editfasilitasForm{{ $fasilita->id }}" action="{{ route('mitra.fasilitas.update', $fasilita->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="editTitle{{ $fasilita->id }}" class="form-label">Nama Homestay</label>
                                            @foreach($homestays as $homestay)
                                            <input type="text" readonly name="homestay_id" id="editTitle{{ $fasilita->id }}" class="form-control" value="{{ $homestay->id }}">
                                            @endforeach
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="editTitle{{ $fasilita->id }}" class="form-label">Fasilitas</label>
                                            @php
                                            $selectedFacilities = explode(', ', $fasilita->title);
                                            @endphp
                                            <input type="checkbox" name="fasilitas[]" value="wifi" {{ in_array('wifi', $selectedFacilities) ? 'checked' : '' }}><label> Wifi</label><br>
                                            <input type="checkbox" name="fasilitas[]" value="ac" {{ in_array('ac', $selectedFacilities) ? 'checked' : '' }}><label> AC</label><br>
                                            <input type="checkbox" name="fasilitas[]" value="dapur" {{ in_array('dapur', $selectedFacilities) ? 'checked' : '' }}><label> Dapur</label><br>
                                            <input type="checkbox" name="fasilitas[]" value="parkir" {{ in_array('parkir', $selectedFacilities) ? 'checked' : '' }}><label> Parkir Mobil</label><br>
                                            <input type="checkbox" name="fasilitas[]" value="tv" {{ in_array('tv', $selectedFacilities) ? 'checked' : '' }}><label> TV</label><br>
                                            <input type="checkbox" name="fasilitas[]" value="receptionist" {{ in_array('receptionist', $selectedFacilities) ? 'checked' : '' }}><label> Receptionist</label><br>
                                            <input type="checkbox" name="fasilitas[]" value="24" {{ in_array('24', $selectedFacilities) ? 'checked' : '' }}><label> 24/7 Check In</label><br>
                                            <input type="checkbox" name="fasilitas[]" value="cctv" {{ in_array('cctv', $selectedFacilities) ? 'checked' : '' }}><label> CCTV</label><br>
                                            <input type="checkbox" name="fasilitas[]" value="card" {{ in_array('card', $selectedFacilities) ? 'checked' : '' }}><label> Card Payment</label><br>
                                            <input type="checkbox" name="fasilitas[]" value="housekeeping" {{ in_array('housekeeping', $selectedFacilities) ? 'checked' : '' }}><label> Daily Housekeeping</label><br>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection