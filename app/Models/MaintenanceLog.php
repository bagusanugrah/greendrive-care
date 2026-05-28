<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceLog extends Model
{
    protected $fillable = ['vehicle_id', 'sparepart_id', 'installed_date', 'status'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function sparepart()
    {
        return $this->belongsTo(Sparepart::class);
    }
}
