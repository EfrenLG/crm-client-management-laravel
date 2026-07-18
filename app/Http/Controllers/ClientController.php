<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $clients = Client::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        })->paginate(5);

        return view('clients.index', compact('clients', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        try {
            $request->user()->clients()->create($request->validated());
        } catch (\Throwable $e) {
            report($e);

            return back()->withInput()->with('error', 'No se pudo crear el cliente. Inténtalo de nuevo.');
        }

        return redirect()->route('clients.index')->with('success', 'Cliente creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        Gate::authorize('view', $client);

        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        Gate::authorize('update', $client);

        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        try {
            $client->update($request->validated());
        } catch (\Throwable $e) {
            report($e);

            return back()->withInput()->with('error', 'No se pudo actualizar el cliente. Inténtalo de nuevo.');
        }

        return redirect()->route('clients.index')->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        Gate::authorize('delete', $client);

        try {
            $client->delete();
        } catch (\Throwable $e) {
            report($e);

            return back()->with('error', 'No se pudo eliminar el cliente. Inténtalo de nuevo.');
        }

        return redirect()->route('clients.index')->with('success', 'Cliente eliminado correctamente.');
    }
}
