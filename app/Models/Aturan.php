<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aturan extends Model
{
    protected $fillable = [
        'penyakit_id',
        'nama_aturan',
        'confidence'
    ];

    protected $casts = [
        'confidence' => 'float'
    ];

    /**
     * Get penyakit yang dihasilkan dari aturan ini
     */
    public function penyakit(): BelongsTo
    {
        return $this->belongsTo(Penyakit::class);
    }

    /**
     * Get gejala-gejala yang diperlukan oleh aturan ini (IF condition)
     */
    public function aturanDetails(): HasMany
    {
        return $this->hasMany(AturanDetail::class);
    }

    /**
     * Get gejala yang diperlukan
     */
    public function gejalas()
    {
        return $this->belongsToMany(Gejala::class, 'aturan_details');
    }
}
