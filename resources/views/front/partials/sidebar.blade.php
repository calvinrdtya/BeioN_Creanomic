<div class="card bg-light border-0 mb-4">
    <div class="card-body">
        @auth
            <div class="text-center">
                <h4 class="font-weight-bold">{{ auth()->user()->name }}</h4>
            </div>
            <div class="row mt-4">
                <div class="col-6 text-center border-right">
                    <h5 class="font-weight-bold mb-0">{{ auth()->user()->points_text }}</h5>
                    <span>B-Poin</span>
                </div>
                <div class="col-6 text-center">
                    <h5 class="font-weight-bold mb-0">{{ \App\Models\HistoryEcotourism::quantityByUser() }}</h5>
                    <span>Recycle</span>
                </div>
            </div>
        @endauth

        @guest
            <h4 class="font-weight-bold">Sudah punya akun?</h4>
            <p>Silahkan masuk terlebih dahulu.</p>
            <a href="{{ route('account.login') }}" class="btn btn-primary">Masuk</a>
            <a href="{{ route('account.register') }}" class="btn btn-link">Daftar</a>
        @endguest
    </div>
</div>

<div class="card card-body bg-light border-0">
    <a href="{{ route('user.order') }}"
        class="w-100 py-3 btn @if (request()->routeIs('account.profile')) btn-primary @else btn-light shadow-none @endif text-left">Akun</a>
    <a href="{{ route('front.ecotourism') }}"
        class="w-100 py-3 btn @if (request()->routeIs('front.ecotourism')) btn-primary @else btn-light shadow-none @endif text-left">Ecotourism</a>
    <a href="{{ route('user.order') }}"
        class="w-100 py-3 btn @if (request()->routeIs('user.order')) btn-primary @else btn-light shadow-none @endif text-left">Riwayat
        Order</a>
    {{-- <a href="{{route('user.order')}}"
        class="w-100 py-3 btn @if (request()->routeIs('user.order')) btn-primary @else btn-light shadow-none @endif text-left">Keamanan</a> --}}
</div>
