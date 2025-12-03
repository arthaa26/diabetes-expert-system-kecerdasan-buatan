<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Activity extends Model
{
    protected $table = 'activities';

    protected $fillable = [
        'user_id',
        'user_name',
        'user_age',
        'action',
        'result_summary',
        'diagnosis_data',
        'selected_gejala',
    ];

    protected $casts = [
        'diagnosis_data' => 'array',
        'selected_gejala' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
