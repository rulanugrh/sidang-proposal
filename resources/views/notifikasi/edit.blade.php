<x-app-layout title="Update Notifikasi">
    <x-page-heading title="Update Notifikasi" subtitle="Halaman update notifikasi">
        <li class="breadcrumb-item "><a href="{{ route('notifikasi.index') }}">Portal Notifikasi</a></li>
        <li class="breadcrumb-item active" aria-current="page">Update Notifikasi</li>
    </x-page-heading>
    <x-form-upload route="{{ route('notifikasi.update', $notifikasi->id) }}" method="POST" overrideMethod="PUT">
        <x-form-group col="col-md-6 col-12" label="Judul Pengumuman" :invalidFeedback="$errors->first('judul_pengumuman')">
            <x-input type="text" name="judul_pengumuman" :value="$notifikasi->judul_pengumuman" placeholder="Masukkan Judul Pengumuman"
                required="true"></x-input>
        </x-form-group>
        <x-form-group label="Isi Pengumuman" :invalidFeedback="$errors->first('isi')">
            <x-textarea type="address" name="isi" :value="$notifikasi->isi" placeholder="Masukkan Isi Pengumuman"
                required="true"></x-textare>
        </x-form-group>
        <x-form-group col="col-12" label="Isi Pengumuman" :invalidFeedback="$errors->first('berkas')">
            <x-input-disabled type="file" name="berkas" :value="$notifikasi->berkas" placeholder="Masukkan Isi Pengumuman"></x-input-disabled>
        </x-form-group>
    </x-form-upload>
</x-app-layout>
