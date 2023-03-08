<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zakat extends Model
{
    use HasFactory;
    protected $table = 'zakat';
    protected $guarded  = [''];
    protected $dates = ['tanggal_transaksi'];

    public function muzakki()
    {
        return $this->belongsTo(Muzakki::class, 'muzakki_id', 'id');
    }

    public function amil()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function anggota_keluarga()
    {
        return $this->hasMany(JumlahJiwa::class, 'zakat_id', 'id');
    }
}
