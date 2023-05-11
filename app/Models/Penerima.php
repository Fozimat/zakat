<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerima extends Model
{
    use HasFactory;
    protected $table = 'penerima';
    protected $guarded  = [''];

    public function golongan()
    {
        return $this->belongsTo(Golongan::class, 'golongan_id', 'id');
    }
}
