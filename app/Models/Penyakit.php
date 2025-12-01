<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penyakit extends Model
{
    protected $fillable = [
        'kode_penyakit',
        'nama_penyakit',
        'deskripsi',
        'penanganan'
    ];

    /**
     * Get aturan yang menghasilkan penyakit ini
     */
    public function aturans(): HasMany
    {
        return $this->hasMany(Aturan::class);
    }
}
