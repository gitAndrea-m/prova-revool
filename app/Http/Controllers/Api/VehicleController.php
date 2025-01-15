<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends ApiController
{
    protected function rules()
    {
        return [
            'license_plate' => 'required|unique'
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicle = Vehicle::all();

        if($vehicle->isEmpty()) $vehicle = 'Nessun veicolo trovato';

        return $this->respond($vehicle);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $this->validate($request, $this->rules());

            $veicolo = new Vehicle([
                'client_id' => $request->input('client_id'),
                'brand' => $request->input('brand'),
                'model' => $request->input('model'),
                'year' => $request->input('year'),
                'license_plate' => $request->input('license_plate'),
            ]);

            $client = Client::find($veicolo->client_id);

            if ( ! $client ){
                throw new \Exception("Il cliente indicato non esiste", 500);
            }

            $veicolo->save();

            return $this->respond([
                $veicolo, 
                "message" => 'Veicolo aggiunto con successo'
            ]);

        } catch (\Throwable $th) {
            
            return $this->respond([
                "error" => 'Errore durante creazione veicolo: ' . $th->getMessage()
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $vehicle = Vehicle::findOrFail($id);

            $vehicle->delete();

            return $this->respondSuccess();
            
        } catch (\Throwable $th) {
            return $this->respond([
                "error" => 'Errore in eliminazione veicolo: ' . $th->getMessage()
            ], 404);
        }
    }
}
