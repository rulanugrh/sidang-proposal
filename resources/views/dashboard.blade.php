<x-app-layout title="Dashboard">
    <div class="page-content" style="min-height: 70vh">
        @auth
            <x-alert-heading type="primary" title="{{ __('Welcome back ,' . $name) }}">
                Bagaimana kabar anda hari ini?
            </x-alert-heading>
        @endauth
        <section class="row">
            <div class="col-12">
                <div class="row">
                    <x-card-with-icon col="col-12 col-lg-4 col-md-6" color="purple" title="Total Mahasiswa"
                        number="{{ $mahasiswa }}">
                        <i class="fas fa-users"></i>
                    </x-card-with-icon>
                    <x-card-with-icon col="col-12 col-lg-4 col-md-6" color="green"
                        title="Total Submit Proposal" number="{{ $proposal }}">
                        <i class="fa fa-users"></i>
                    </x-card-with-icon>
                </div>
            </div>
        </section>
        @foreach ($notifikasi as $nf)
            <section class="row">
                <div class="col-12">
                    <div class="row">
                        <x-card-for-information col="col-12" number="{{ $nf->nim }}" title="{{ $nf->judul_pengumuman}}"
                            isi="{{ $nf->isi }}">
                        </x-card-for-information>
                    </div>
                </div>
            </section>
        @endforeach
        @push('spesific-css')
            <link rel="stylesheet" href="{{ asset('assets/extension/font-awesome/webfonts/font-awesome.css') }}">
        @endpush
</x-app-layout>
