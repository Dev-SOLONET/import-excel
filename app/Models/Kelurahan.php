<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;

    protected $table = 'reg_villages';

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'district_id');
    }

}
