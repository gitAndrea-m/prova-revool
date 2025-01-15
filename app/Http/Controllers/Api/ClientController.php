<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends ApiController
{
    protected function rules()
    {
        return [
            'name' => 'required|max:3',
            'email' => 'required|email'
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();

        if($clients->isEmpty()) $clients = 'Nessun cliente presente';

        return $this->respond($clients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {

            $this->validate($request, $this->rules());

            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
            ];

            Client::create($data);

            return $this->respond([
                "message" => 'Cliente aggiunto con successo'
            ]);

        } catch (\Throwable $th) {
            
            return $this->respond([
                "error" => 'Errore durante creazione cliente: ' . $th->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $this->validate($request,[
                'name' => 'required|max:3',
                'email' => 'required|email'
            ]);

            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
            ];

            $client = Client::findOrFail($id)->update($data);
        
            return $this->respond([
                $client, 
                "message" => 'Cliente aggiornato con successo'
            ]);

        } catch (\Throwable $th) {
            
            return $this->respond([
                "error" => 'Errore durante l\'aggiornamento del cliente: ' . $th->getMessage()
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $client = Client::findOrFail($id);
            
            return $this->respond($client);
            
        } catch (\Throwable $th) {
            return $this->respond([
                "error" => 'Cliente non trovato'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $client = Client::findOrFail($id);

            $client->delete();

            return $this->respondSuccess();
            
        } catch (\Throwable $th) {
            return $this->respond([
                "error" => 'Errore in eliminazione cliente: ' . $th->getMessage()
            ], 404);
        }
    }
}
