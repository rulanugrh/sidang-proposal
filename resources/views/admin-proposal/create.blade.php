<x-app-layout title="Upload Data Proposal">
    <x-page-heading title="Data Proposal" subtitle="Halaman proposal mahasiswa">
        <li class="breadcrumb-item "><a href="{{ route('admin-proposal.index') }}">Proposal Mahasiswa</a></li>
        <li class="breadcrumb-item active" aria-current="page">Upload Data Proposal Mahasiswa</li>
    </x-page-heading>
    <x-form-upload route="{{ route('admin-proposal.store') }}" method="POST">
        <x-form-group col="col-md-6 col-12" label="NIM Mahasiswa" :invalidFeedback="$errors->first('NIM')">
            <x-input type="text" name="NIM" :value="old('NIM')" placeholder="Masukan NIM Mahasiswa"
                required="true"></x-input>
        </x-form-group>
        <x-form-group col="col-md-6 col-12" label="Judul Proposal" :invalid-feedback="$errors->first('judul')">
            <x-input type="text" name="judul" :value="old('judul')" placeholder="Masukkan Judul Proposal" required="true"></x-input>
        </x-form-group>
        <x-form-group col="col-md-6 col-12" label="Dosen Pembimbing" :invalid-feedback="$errors->first('dosen_pembimbing')">
            <x-input type="text" name="dosen_pembimbing" :value="old('dosen_pembimbing')" placeholder="Masukan Dosen Pembimbing" required="true"></x-input>
        </x-form-group>
        <x-form-group col="col-md-6 col-12" label="Jenis Sidang " :invalid-feedback="$errors->first('jenis_sidang')">
            <x-input type="text" name="jenis_sidang" :value="old('jenis_sidang')" placeholder="Masukan Jenis Sidang" required="true"></x-input>
        </x-form-group>
        <x-form-group col="col-md-6 col-12" label="Berkas" :invalid-feedback="$errors->first('berkas')">
            <x-input type="file" name="berkas" :value="old('berkas')" placeholder="Masukan Berkass" required="true"></x-input>
        </x-form-group>
        <x-form-group col="col-md-6 col-12" label="Email Mahasiswa" :invalid-feedback="$errors->first('email')">
            <x-input type="email" name="email" :value="old('email')" placeholder="Masukan Emailmu" required="true"></x-input>
        </x-form-group>
        {{-- <x-form-group label="Jadwal Sidang" :invalidFeedback="$errors->first('jadwal_sidang')">
            <x-input type="date" name="jadwal_sidang" :value="old('jadwal_sidang')" placeholder="Masukkan Jadwal Sidang"
                required="true"></x-input>
        </x-form-group> --}}
    </x-form-upload>
</x-app-layout>
