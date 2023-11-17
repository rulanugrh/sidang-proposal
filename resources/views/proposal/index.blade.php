<x-app-layout title="Proposal Mahasiswa">
    <x-page-heading title="Submit Proposal" subtitle="Halaman submitting proposal">
        <li class="breadcrumb-item active" aria-current="page">Submit Proposal</li>
    </x-page-heading>
    <x-section-card title="Submit Proposal">
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
                <th>Link Zoom</th>
            </x-slot>
            <tr>
                <td>1</td>
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
                    <a href="{{$proposal->link_zoom}}">
                        Link Meeting
                    </a>
                    
                </td>
                <td>
                    <x-edit-delete-action>
                        <x-slot name="routeEdit">{{ route('proposal.edit', $proposal->id) }}</x-slot>
                        <x-slot name="routeDelete">{{ route('proposal.destroy', $proposal->id) }}</x-slot>
                    </x-edit-delete-action>
                </td>
            </tr>
        </x-table>
    </x-section-card>
</x-app-layout>
