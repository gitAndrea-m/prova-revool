<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\StoreServiceRequest;
use App\Models\Service;

class ServiceController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $service = Service::all();

        if($service->isEmpty()) $service = 'Nessun intervento trovato';

        return $this->respond($service);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        try {
            $service = Service::create($request->validated());

            return $this->respond([
                $service, 
                "message" => 'Intervento aggiunto con successo'
            ]);

        } catch (\Throwable $th) {
            
            return $this->respond([
                "error" => 'Errore durante creazione intervento: ' . $th->getMessage()
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $service = Service::findOrFail($id);

            $service->delete();

            return $this->respondSuccess();
            
        } catch (\Throwable $th) {
            return $this->respond([
                "error" => 'Errore in eliminazione intervento: ' . $th->getMessage()
            ], 404);
        }
    }
}
