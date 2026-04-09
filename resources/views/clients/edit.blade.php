@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card p-4">
        <div class="container mt-5">

            <h1>Editar cliente</h1>

            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif

            <form action="/clients/{{ $client->id }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <input type="text" name="name" value="{{ $client->name }}" class="form-control">
                </div>

                <div class="mb-3">
                    <input type="email" name="email" value="{{ $client->email }}" class="form-control">
                </div>

                <div class="mb-3">
                    <input type="text" name="phone" value="{{ $client->phone }}" class="form-control">
                </div>

                <button class="btn btn-primary">Actualizar</button>
            </form>

        </div>
    </div>
</div>
@endsection