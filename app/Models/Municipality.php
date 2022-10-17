<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;

    protected $table = 'municipalities';

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'key',
        'name',
    ];

    public function zip_codes()
    {
        return $this->hasMany(ZipCode::class);
    }

}
