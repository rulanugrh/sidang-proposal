<x-app-layout title="Ubah Data Proposal Mahasiswa">
    <x-page-heading title="Ubah Data Proposal Mahasiswa" subtitle="Halaman ubah data proposal mahasiswa">
        <li class="breadcrumb-item "><a href="{{ route('admin-proposal.index') }}">Proposal Mahasiswa</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ubah Data Proposal Mahasiswa</li>
    </x-page-heading>
    <x-form-upload route="{{ route('admin-proposal.update', $admin_proposal->id) }}" method="POST" overrideMethod="PUT">
        <x-form-group col="col-md-6 col-12" label="NIM" :invalid-feedback="$errors->first('NIM')">
            <x-input type="text" name="NIM" :value="$admin_proposal->NIM" placeholder="Masukkan NIM"
                required="true"></x-input>
        </x-form-group>
        <x-form-group col="col-md-6 col-12" label="Judul Proposal" :invalidFeedback="$errors->first('judul')">
            <x-input type="text" name="judul" :value="$admin_proposal->judul" placeholder="Masukkan Judul Proposal"
                required="true"></x-input>
        </x-form-group>
        <x-form-group col="col-md-6 col-12" label="Nama Dosen Pembimbing" :invalidFeedback="$errors->first('dosen_pembimbing')">
            <x-input type="text" name="dosen_pembimbing" :value="$admin_proposal->dosen_pembimbing" placeholder="Masukkan Nama Dosen Pembimbing"
                required="true"></x-input>
        </x-form-group>
        <x-form-group col="col-md-6 col-12" label="Jenis Sidang" :invalidFeedback="$errors->first('jenis_sidang')">
            <x-input type="text" name="jenis_sidang" :value="$admin_proposal->jenis_sidang" placeholder="Masukkan Jenis Sidang"
                required="true"></x-input>
        </x-form-group>
        <x-form-group col="col-md-6 col-12" label="Berkas Proposal" :invalidFeedback="$errors->first('berkas')">
            <x-input-disabled type="text" name="berkas" :value="$admin_proposal->berkas" placeholder="Masukkan Berkas Sidang"></x-input-disabled>
        </x-form-group>
        <x-form-group col="col-md-6 col-12" label="Link Zoom" :invalidFeedback="$errors->first('link_zoom')">
            <x-input type="text" name="link_zoom" :value="$admin_proposal->link_zoom" placeholder="Masukkan Link Zoom"
                required="true"></x-input>
        </x-form-group>
        <x-form-group col="col-12" label="Email Mahasiswa" :invalidFeedback="$errors->first('email')">
            <x-input type="email" name="email" :value="$admin_proposal->email" placeholder="Masukkan Email Mahasiswa"
                required="true"></x-input>
        </x-form-group>
        <x-form-group label="Jadwal Sidang" :invalidFeedback="$errors->first('jadwal_sidang')">
            <x-input type="date" name="jadwal_sidang" :value="$admin_proposal->jadwal_sidang" placeholder="Masukkan Jadwal Sidang"
                required="true"></x-input>
        </x-form-group>
        <x-form-group label="Waktu Sidang" :invalidFeedback="$errors->first('pukul')">
            <x-input type="time" name="pukul" :value="$admin_proposal->pukul" placeholder="Masukkan Waktu Sidang"
                required="true"></x-input>
        </x-form-group>
    </x-form-upload>
</x-app-layout>
