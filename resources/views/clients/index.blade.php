<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-md px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                    <form method="GET" action="{{ route('clients.index') }}" class="w-full sm:max-w-xs">
                        <x-text-input type="text" name="search" value="{{ $search ?? '' }}"
                            class="w-full" placeholder="Buscar por nombre o email..." />
                    </form>

                    <a href="{{ route('clients.create') }}">
                        <x-primary-button>
                            {{ __('+ Nuevo cliente') }}
                        </x-primary-button>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead>
                            <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <th class="px-4 py-3">Nombre</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Teléfono</th>
                                <th class="px-4 py-3 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($clients as $client)
                                <tr>
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ $client->name }}</td>
                                    <td class="px-4 py-3 text-gray-600">{{ $client->email }}</td>
                                    <td class="px-4 py-3 text-gray-600">{{ $client->phone }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('clients.edit', $client) }}">
                                                <x-secondary-button type="button">
                                                    {{ __('Editar') }}
                                                </x-secondary-button>
                                            </a>

                                            <form action="{{ route('clients.destroy', $client) }}" method="POST"
                                                onsubmit="return confirm('¿Eliminar a {{ $client->name }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button>
                                                    {{ __('Eliminar') }}
                                                </x-danger-button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                        {{ __('No hay clientes que coincidan con tu búsqueda.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $clients->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
