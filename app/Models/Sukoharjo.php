<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sukoharjo extends Model
{
    use HasFactory;

    protected $table = 'SUKOHARJO';

    protected $fillable = [
        'kelurahan_id',
        'kecamatan_id',
        'kabupaten_id',
        'provinsi_id',
    ];

    // timestamp false
    public $timestamps = false; 
}
