@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card p-4">
        <div class="container mt-5">

            <h1>Crear cliente</h1>

            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif

            <form action="/clients" method="POST">
                @csrf

                <div class="mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Nombre">
                </div>

                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>

                <div class="mb-3">
                    <input type="text" name="phone" class="form-control" placeholder="Teléfono">
                </div>

                <button class="btn btn-success">Guardar</button>
            </form>

        </div>
    </div>
</div>
@endsection