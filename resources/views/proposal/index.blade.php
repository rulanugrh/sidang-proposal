<x-app-layout title="Proposal Mahasiswa">
    <x-page-heading title="Submit Proposal" subtitle="Halaman seluruh data proposal mahasiswa">
        <li class="breadcrumb-item active" aria-current="page">Submit Proposal</li>
    </x-page-heading>
    <x-section-card title="Submit Proposal">
        <x-button-create>
            <x-slot name="routeTambah">{{ route('proposal.create') }}</x-slot>
        </x-button-create>
        <x-table>
            <x-slot name="column">
                <th>NIM</th>
                <th>Email</th>
                <th>Judul Sidang</th>
                <th>Dosen Pembimbing</th>
                <th>Jenis Sidang</th>
                <th>Berkas Proposal</th>
                <th>Jadwal Sidang</th>
                <th>Waktu Sidang</th>
            </x-slot>
            <tr>
                <td>{{ $proposals->NIM }}</td>
                <td>{{ $proposals->email }}</td>
                <td>{{ $proposals->judul }}</td>
                <td>{{ $proposals->dosen_pembimbing }}</td>
                <td>{{ $proposals->jenis_sidang }}</td>
                <td>
                    <a href="{{'upload/pengajuan/proposal/'. $proposals->berkas}}">
                        {{ $proposals->berkas }}
                    </a>
                    
                </td>
                <td>{{ $proposals->jadwal_sidang }}</td>
                <td>{{ $proposals->waktu_sidang }}</td>
                <td>
                    <x-edit-delete-action>
                        <x-slot name="routeEdit">{{ route('proposal.edit', $proposals->NIM) }}</x-slot>
                        <x-slot name="routeDelete">{{ route('proposal.destroy', $proposals->NIM) }}</x-slot>
                    </x-edit-delete-action>
                </td>
            </tr>
        </x-table>
    </x-section-card>
    <x-sa-warning></x-sa-warning>
</x-app-layout>
