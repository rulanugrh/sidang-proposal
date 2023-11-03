<x-app-layout title="Tambah Data Mahasiswa">
    <x-page-heading title="Tambah Data Mahasiswa" subtitle="Halaman tambah data mahasiswa">
        <li class="breadcrumb-item "><a href="{{ route('mahasiswa.index') }}">Mahasiswa</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Data Mahasiswa</li>
    </x-page-heading>
    <x-form route="{{ route('mahasiswa.store') }}" method="POST">
        <x-form-group col="col-md-6 col-12" label="Email Mahasiswa" :invalidFeedback="$errors->first('email')">
            <x-input type="email" name="email" :value="old('email')" placeholder="Masukkan Email Mahasiswa"
                required="true"></x-input>
        </x-form-group>
        <x-form-group col="col-md-6 col-12" label="Nama Mahasiswa" :invalid-feedback="$errors->first('name')">
            <x-input type="text" name="name" :value="old('name')" placeholder="Masukkan Nama Kamu" required="true"></x-input>
        </x-form-group>
        <x-form-group col="col-12" label="NIM Mahasiswa" :invalid-feedback="$errors->first('NIM')">
            <x-input type="text" name="NIM" :value="old('NIM')" placeholder="Masukkan NIM Kamu" required="true"></x-input>
        </x-form-group>
        <x-form-group label="Tanggal Lahir" :invalidFeedback="$errors->first('date_of_birth')">
            <x-input type="date" name="date_of_birth" :value="old('date_of_birth')" placeholder="Masukkan Tanggal Lahir"
                required="true"></x-input>
        </x-form-group>
        <x-form-group label="Alamat" :invalidFeedback="$errors->first('address')">
            <x-textarea name="address" :value="old('address')" placeholder="Masukkan Alamat" required="true"></x-textarea>
        </x-form-group>
    </x-form>
</x-app-layout>
