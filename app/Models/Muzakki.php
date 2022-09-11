<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muzakki extends Model
{
    use HasFactory;
    protected $table = 'muzakki';
    protected $guarded  = [''];

    public function zakat()
    {
        return $this->hasMany(Zakat::class, 'muzakki_id', 'id');
    }
}
