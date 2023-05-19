<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    use HasFactory;
    protected $table = 'golongan';
    protected $guarded  = [''];

    public function penerima()
    {
        return $this->hasMany(Penerima::class, 'golongan_id', 'id');
    }
}
