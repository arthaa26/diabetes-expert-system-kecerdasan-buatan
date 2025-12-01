<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AturanDetail extends Model
{
    protected $fillable = [
        'aturan_id',
        'gejala_id'
    ];

    /**
     * Get aturan yang menggunakan gejala ini
     */
    public function aturan(): BelongsTo
    {
        return $this->belongsTo(Aturan::class);
    }

    /**
     * Get gejala
     */
    public function gejala(): BelongsTo
    {
        return $this->belongsTo(Gejala::class);
    }
}
