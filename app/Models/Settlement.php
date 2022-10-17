<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    use HasFactory;

    protected $table = 'settlements';

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'settlement_type_id',
        'zip_code_id'
    ];

    protected $fillable = [
        'name',
        'key',
        'zone_type',
        'settlement_type_id',
        'zip_code_id',
    ];

    public function settlement_type()
    {
        return $this->belongsTo(SettlementType::class, 'settlement_type_id', 'id');
    }

    public function zip_codes()
    {
        return $this->hasMany(ZipCode::class);
    }

    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function getZoneTypeAttribute($value)
    {
        return strtoupper($value);
    }
    
}
