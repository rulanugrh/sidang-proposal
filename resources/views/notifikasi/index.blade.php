<x-app-layout title="Portal Notifikasi">
    <x-page-heading title="Portal Notifikasi" subtitle="Halaman membuat informasi">
        <li class="breadcrumb-item active" aria-current="page">Portal Notifikasi</li>
    </x-page-heading>
    <x-section-card title="Portal Notifikasi">
        <x-button-create>
            <x-slot name="routeTambah">{{ route('notifikasi.create') }}</x-slot>
        </x-button-create>
        <x-table>
            <x-slot name="column">
                <th>Judul Pengumuman</th>
                <th>Isi</th>
                <th>NIM Mahasiswa</th>
            </x-slot>
            @foreach ($notifikasis as $notifikasi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $notifikasi->judul_pengumuman }}</td>
                    <td>{{ $notifikasi->isi }}</td>
                    <td>{{ $notifikasi->nim }}</td>
                    <td>
                        <x-edit-delete-action>
                            <x-slot name="routeEdit">{{ route('notifikasi.edit', $notifikasi->id) }}</x-slot>
                            <x-slot name="routeDelete">{{ route('notifikasi.destroy', $notifikasi->id) }}</x-slot>
                        </x-edit-delete-action>
                    </td>
                </tr>
            @endforeach
        </x-table>
    </x-section-card>
</x-app-layout>
