<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'brand',
        'model',
        'year',
        'license_plate',
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
