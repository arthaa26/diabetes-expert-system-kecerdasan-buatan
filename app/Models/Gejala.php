<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gejala extends Model
{
    protected $fillable = [
        'kode_gejala',
        'nama_gejala',
        'deskripsi'
    ];

    /**
     * Get aturan details yang menggunakan gejala ini
     */
    public function aturanDetails(): HasMany
    {
        return $this->hasMany(AturanDetail::class);
    }
}
