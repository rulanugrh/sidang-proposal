<x-app-layout title="Portal Event">
    <x-page-heading title="Portal Event" subtitle="Halaman membuat Event">
        <li class="breadcrumb-item active" aria-current="page">Portal Event</li>
    </x-page-heading>
    <x-section-card title="Portal Event">
        <x-button-create>
            <x-slot name="routeTambah">{{ route('event.create') }}</x-slot>
        </x-button-create>
        <x-table>
            <x-slot name="column">
                <th>Judul</th>
                <th>Jurusan</th>
                <th>Mulai</th>
                <th>Berakhir</th>
            </x-slot>
            @foreach ($events as $event)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->url }}</td>
                    <td>{{ $event->start }}</td>
                    <td>{{ $event->end }}</td>
                    <td>
                        <x-edit-delete-action>
                            <x-slot name="routeEdit">{{ route('event.edit', $event->id) }}</x-slot>
                            <x-slot name="routeDelete">{{ route('event.destroy', $event->id) }}</x-slot>
                        </x-edit-delete-action>
                    </td>
                </tr>
            @endforeach
        </x-table>
    </x-section-card>
</x-app-layout>
