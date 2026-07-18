<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-md px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <dl class="divide-y divide-gray-100">
                    <div class="py-3 grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-500">Nombre</dt>
                        <dd class="text-sm text-gray-900 col-span-2">{{ $client->name }}</dd>
                    </div>
                    <div class="py-3 grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="text-sm text-gray-900 col-span-2">{{ $client->email }}</dd>
                    </div>
                    <div class="py-3 grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-500">Teléfono</dt>
                        <dd class="text-sm text-gray-900 col-span-2">{{ $client->phone ?: '—' }}</dd>
                    </div>
                </dl>

                <div class="mt-6 flex items-center gap-3">
                    @can('update', $client)
                        <a href="{{ route('clients.edit', $client) }}">
                            <x-primary-button>{{ __('Editar') }}</x-primary-button>
                        </a>
                    @endcan
                    <a href="{{ route('clients.index') }}">
                        <x-secondary-button type="button">{{ __('Volver') }}</x-secondary-button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
