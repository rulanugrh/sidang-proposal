<x-app-layout title="Proposal Mahasiswa">
    <x-page-heading title="Submit Proposal" subtitle="Halaman seluruh data proposal mahasiswa">
        <li class="breadcrumb-item active" aria-current="page">Submit Proposal</li>
    </x-page-heading>
    <x-section-card title="Submit Proposal">
        <x-button-create-print-export>
            <x-slot name="routeTambah">{{ route('admin-proposal.create') }}</x-slot>
            <x-slot name="routePrint">{{ route('admin-proposal.pdf') }}</x-slot>
            <x-slot name="routeExport">{{ route('admin-proposal.excel') }}</x-slot>
        </x-button-create-print-export>
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
            @foreach ($proposals as $proposal)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $proposal->NIM }}</td>
                    <td>{{ $proposal->email }}</td>
                    <td>{{ $proposal->judul }}</td>
                    <td>{{ $proposal->dosen_pembimbing }}</td>
                    <td>{{ $proposal->jenis_sidang }}</td>
                    <td>
                        <a href="{{'upload/pengajuan/proposal/'. $proposal->berkas}}">
                            {{ $proposal->berkas }}
                        </a>
                        
                    </td>
                    <td>{{ $proposal->jadwal_sidang }}</td>
                    <td>{{ $proposal->pukul }}</td>
                    <td>
                        <x-edit-delete-action>
                            <x-slot name="routeEdit">{{ route('admin-proposal.edit', $proposal->id) }}</x-slot>
                            <x-slot name="routeDelete">{{ route('admin-proposal.destroy', $proposal->id) }}</x-slot>
                        </x-edit-delete-action>
                    </td>
                </tr>
            @endforeach
        </x-table>
    </x-section-card>
    <x-sa-warning></x-sa-warning>
</x-app-layout>
