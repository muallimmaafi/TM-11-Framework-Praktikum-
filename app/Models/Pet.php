<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RasHewan;
use App\Models\Pemilik;

class Pet extends Model
{
    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'warna_tanda',
        'jenis_kelamin',
        'idpemilik',
        'idras_hewan'
    ];

    // Relasi ke tabel ras_hewan (FK: idras_hewan)
    public function rasHewan()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
    }

    // Relasi ke tabel pemilik (FK: idpemilik)
    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }

    //mematikan created_at dan updated_at
    public $timestamps = false;
}
