<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model
{
    use HasFactory;

    protected $table = 'zip_codes';

    //not show some columns
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'municipality_id',
        'federal_entity_id',
        'settlement_id'
    ];


    public function municipality()
    {
        return $this->belongsTo(Municipality::class, 'municipality_id', 'id');
    }

    public function federal_entity()
    {
        return $this->belongsTo(FederalEntity::class, 'federal_entity_id', 'id');
    }

    public function settlements()
    {
        return $this->hasMany(Settlement::class, 'zip_code_id', 'id')->with('settlement_type');
    }

    public function getLocalityAttribute($value)
    {
        return strtoupper($value);
    }
}
