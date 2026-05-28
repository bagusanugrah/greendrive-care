<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    protected $fillable = ['name', 'category', 'estimated_lifespan_days'];

    public function maintenanceLogs()
    {
        return $this->hasMany(MaintenanceLog::class);
    }
}