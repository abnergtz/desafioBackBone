<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettlementType extends Model
{
    use HasFactory;

    protected $table = 'settlements_type';

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
    ];

    //settlement_type has many settlements
    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }
}
