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
        <section class="row">
            <div class="col-7">
                <h6>Calendar</h6>
                <div id="calendar"></div>
            </div>
            <div class="col-5">
                <div class="row">
                    <h6>Notifikasi</h6>
                    @foreach ($notifikasi as $nf)
                        <x-card-for-information col="col-12" title="{{ $nf->judul_pengumuman}}"
                            isi="{{ $nf->isi }}" link="{{ 'upload/berkas/penting/'. $nf->berkas }}">
                        </x-card-for-information>
                    @endforeach
                </div>
            </div>
        </section>
        @push('spesific-css')
            <link rel="stylesheet" href="{{ asset('assets/extension/font-awesome/webfonts/font-awesome.css') }}">
        @endpush

        <script>

            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events : @json($events)
                });
                calendar.render();
            });
        
        </script>
</x-app-layout>
