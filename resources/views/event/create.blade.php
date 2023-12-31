<x-app-layout title="Create Event">
    <x-page-heading title="Buat Event" subtitle="Halaman membuat event">
        <li class="breadcrumb-item "><a href="{{ route('event.index') }}">Portal Event</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Event</li>
    </x-page-heading>
    <x-form route="{{ route('event.store') }}" method="POST">
        <x-form-group col="col-md-6 col-12" label="Judul Event" :invalid-feedback="$errors->first('title')">
            <x-input type="text" name="title" :value="old('title')" placeholder="Masukan Judul Event"
                required="true"></x-input>
        </x-form-group>
        <x-form-group col="col-md-6 col-12" label="Jurusan" :invalid-feedback="$errors->first('url')">
            <x-input type="text" name="url" :value="old('url')" placeholder="Masukkan Jurusan" required="true"></x-input>
        </x-form-group>
        <x-form-group col="col-md-6 col-12" label="Event Mulai" :invalidFeedback="$errors->first('start')">
            <x-input type="date" id="start" name="start" :value="old('staart')" placeholder="Masukkan Tanggal Event Berakhir"
                required="true"></x-input>
        </x-form-group>
        <x-form-group col="col-md-6 col-12" label="Event Berakhir" :invalidFeedback="$errors->first('end')">
            <x-input type="date" id="end" name="end" :value="old('end')" placeholder="Masukkan Tanggal Event Berakhir"
                required="true"></x-input>
        </x-form-group>
    </x-form>
</x-app-layout>
