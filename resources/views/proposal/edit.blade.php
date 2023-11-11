<x-app-layout title="Ubah Data Proposal">
    <x-page-heading title="Ubah Data Proposal" subtitle="Halaman ubah data proposal">
        <li class="breadcrumb-item "><a href="{{ route('proposal.index') }}">Submission Proposal</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ubah Data Proposal</li>
    </x-page-heading>
    <x-form-upload route="{{ route('proposal.update', $proposal->id) }}" method="POST" overrideMethod="PUT">
        <x-form-group col="col-md-6 col-12" label="NIM" :invalid-feedback="$errors->first('NIM')">
            <x-input type="text" name="NIM" :value="$proposal->NIM" placeholder="Masukkan NIM"
                required="true"></x-input>
        </x-form-group>
        <x-form-group col="col-md-6 col-12" label="Judul Proposal" :invalidFeedback="$errors->first('judul')">
            <x-input type="text" name="judul" :value="$proposal->judul" placeholder="Masukkan Judul Proposal"
                required="true"></x-input>
        </x-form-group>
        <x-form-group col="col-md-6 col-12" label="Nama Dosen Pembimbing" :invalidFeedback="$errors->first('dosen_pembimbing')">
            <x-input type="text" name="dosen_pembimbing" :value="$proposal->dosen_pembimbing" placeholder="Masukkan Nama Dosen Pembimbing"
                required="true"></x-input>
        </x-form-group>
        <x-form-group col="col-md-6 col-12" label="Jenis Sidang" :invalidFeedback="$errors->first('jenis_sidang')">
            <x-input type="text" name="jenis_sidang" :value="$proposal->jenis_sidang" placeholder="Masukkan Jenis Sidang"
                required="true"></x-input>
        </x-form-group>
        <x-form-group col="col-md-6 col-12" label="Email Mahasiswa" :invalidFeedback="$errors->first('email')">
            <x-input type="email" name="email" :value="$proposal->email" placeholder="Masukkan Email Mahasiswa"
                required="true"></x-input>
        </x-form-group>
        <x-form-group label="Update Berkas Proposal" :invalidFeedback="$errors->first('berkas')">
            <x-input type="file" name="berkas" :value="old('berkas')" placeholder="Masukkan Berkas Sidang" required="true"></x-input>
        </x-form-group>

        <x-form-group label="Jadwal Sidang" :invalidFeedback="$errors->first('jadwal_sidang')">
            <x-input-disabled type="date" name="jadwal_sidang" :value="$proposal->jadwal_sidang" placeholder="Jadwal Sidang"></x-input-disabled>
        </x-form-group>
        <x-form-group label="Waktu Sidang" :invalidFeedback="$errors->first('pukul')">
            <x-input-disabled type="time" name="pukul" :value="$proposal->pukul" placeholder="Waktu Sidang" ></x-input-disabled>
        </x-form-group>
    </x-form-upload>
</x-app-layout>
