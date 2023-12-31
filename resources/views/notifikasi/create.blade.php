<x-app-layout title="Create Notifikasi">
    <x-page-heading title="List Notifikasi" subtitle="Halaman membuat notifikasi">
        <li class="breadcrumb-item "><a href="{{ route('notifikasi.index') }}">Portal Notifikasi</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Notifikasi</li>
    </x-page-heading>
    <x-form-upload route="{{ route('notifikasi.store') }}" method="POST">
        <x-form-group col="ccol-12" label="Judul Pengumuman" :invalid-feedback="$errors->first('judul_pengumuman')">
            <x-input type="text" name="judul_pengumuman" :value="old('judul_pengumuman')" placeholder="Masukkan Judul Pengumuman" required="true"></x-input>
        </x-form-group>
        <x-form-group label="Isi Pengumuman" :invalid-feedback="$errors->first('isi')">
            <x-textarea type="address" name="isi" :value="old('isi')" placeholder="Isi Pengumuman" required="true"></x-textarea>
        </x-form-group>
        <x-form-group col="col-12" label="Berkas" :invalid-feedback="$errors->first('berkas')">
            <x-input type="file" name="berkas" :value="old('berkas')" placeholder="Masukan File" required="true"></x-input>
        </x-form-group>
    </x-form-upload>
</x-app-layout>
