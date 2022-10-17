<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FederalEntity extends Model
{
    use HasFactory;

    protected $table = 'federals_entity';

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function zip_codes()
    {
        return $this->hasMany(ZipCode::class);
    }
}
