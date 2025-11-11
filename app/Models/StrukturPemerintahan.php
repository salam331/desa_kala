<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StrukturPemerintahan extends Model
{
    protected $fillable = [
        'nama',
        'jabatan',
        'foto',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    // Scope untuk active records
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk ordering
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan')->orderBy('id');
    }
}
