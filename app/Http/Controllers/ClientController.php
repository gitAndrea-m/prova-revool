<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();

        return view('clients.index', compact('clients'));
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
        $data = $request->validated();

        try {
            
            Client::create($data);

            return redirect()->route('clients.index')->with('success', 'Cliente creato con successo');

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error', 'Si è verificato un errore inatteso durante la creazione']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::findOrFail($id);

        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('clients.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, string $id)
    {
        $data = $request->validated();

        try {
            
            Client::update($data);

            return redirect()->route('clients.index')->with('success', 'Cliente aggiornato con successo');

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error', 'Si è verificato un errore inatteso durante l\'aggiornamento']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            
            Client::findOrFail($id)->delete();

            return view('clients.index')->with('success', 'Cliente eliminato con successo');;

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error', 'Si è verificato un errore inatteso durante l\'eliminazione']);
        }
        
    }
}
