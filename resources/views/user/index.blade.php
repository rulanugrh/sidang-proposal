<x-app-layout title="Setting Profile">
    <x-page-heading title="Setting Profile" subtitle="Halaman setting profile user">
        <li class="breadcrumb-item active" aria-current="page">Setting Profile</li>
    </x-page-heading>
    <x-section-card title="Setting Profile">
        @if (!auth()->guest() && auth()->user()->authGroup->id === 1)
            <x-table>
                <x-slot name="column">
                    <th>Email</th>
                    <th>Name</th>
                </x-slot>
                <tr>
                    <td>1</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                        <x-edit-action>
                            <x-slot name="routeEdit">{{ route('user.edit', $user->id) }}</x-slot>
                        </x-edit-action>
                    </td>
                </tr>
            </x-table>
            
        @else
            <x-table>
                <x-slot name="column">
                    <th>NIM</th>
                    <th>Name</th>
                </x-slot>
                <tr>
                    <td>1</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                        <x-edit-action>
                            <x-slot name="routeEdit">{{ route('user.edit', $user->id) }}</x-slot>
                        </x-edit-action>
                    </td>
                </tr>
            </x-table>
        @endif
        
    </x-section-card>
</x-app-layout>
