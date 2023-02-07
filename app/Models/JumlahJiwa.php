<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JumlahJiwa extends Model
{
    use HasFactory;
    protected $table = 'jumlah_jiwa';
    protected $guarded  = [''];

    public function zakat()
    {
        return $this->hasMany(Zakat::class, 'zakat_id', 'id');
    }
}
