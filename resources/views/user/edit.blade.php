<x-app-layout title="Setting Profle">
    <x-page-heading title="Setting Profile" subtitle="Halaman ubah data user">
        <li class="breadcrumb-item "><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Setting Profile</li>
    </x-page-heading>
    @if (!auth()->guest() && auth()->user()->authGroup->id === 1)
        <x-form route="{{ route('user.update', $user->id) }}" method="POST" overrideMethod="PUT">
            <x-form-group col="col-md-6 col-12" label="Email Admin" :invalid-feedback="$errors->first('email')">
                <x-input type="text" name="email" :value="$user->email" placeholder="Email Admin"
                    required="true"></x-input>
            </x-form-group>
            <x-form-group col="col-md-6 col-12" label="Nama Admin" :invalidFeedback="$errors->first('name')">
                <x-input type="text" name="name" :value="$user->name" placeholder="Custom Name Admin"
                    required="true"></x-input>
            </x-form-group>
            <x-form-group col="col-12" label="Masukan Password" :invalidFeedback="$errors->first('password')">
                <x-input type="password" name="password" :value="old('description')"  placeholder="Masukkan Password"
                    required="true"></x-input>
            </x-form-group>
        </x-form>
        
    @else
        <x-form route="{{ route('user.update', $user->id) }}" method="POST" overrideMethod="PUT">
            <x-form-group col="col-md-6 col-12" label="NIM Mahasiswa" :invalid-feedback="$errors->first('email')">
                <x-input type="text" name="email" :value="$user->email" placeholder="Masukkan NIM"
                    required="true"></x-input>
            </x-form-group>
            <x-form-group col="col-md-6 col-12" label="Nama Mahasiswa" :invalidFeedback="$errors->first('name')">
                <x-input type="text" name="name" :value="$user->name" placeholder="Masukkan Nama"
                    required="true"></x-input>
            </x-form-group>
            <x-form-group col="col-12" label="Masukan Password" :invalidFeedback="$errors->first('password')">
                <x-input type="password" name="password" :value="old('password')" placeholder="Masukkan Password"
                    required="true"></x-input>
            </x-form-group>
        </x-form>
    @endif
</x-app-layout>
