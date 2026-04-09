@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <div class="card p-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Clientes</h1>
            <a href="/clients/create" class="btn btn-primary">+ Nuevo</a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <form method="GET" action="/clients" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control" placeholder="Buscar cliente...">
                <button class="btn btn-outline-secondary">Buscar</button>
            </div>
        </form>

        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($clients as $client)
                <tr>
                    <td><strong>{{ $client->name }}</strong></td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->phone }}</td>
                    <td class="text-end">

                        <a href="/clients/{{ $client->id }}/edit" class="btn btn-sm btn-warning">
                            Editar
                        </a>

                        <form action="/clients/{{ $client->id }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                Eliminar
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $clients->links() }}
        </div>

    </div>

</div>
@endsection