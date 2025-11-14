<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Galeri extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'deskfoto',
        'gambar',
        'kategori',
        'album',
        'tanggal',
        'is_active',
        'parent_id',
        'is_parent'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'is_active' => 'boolean',
        'is_parent' => 'boolean'
    ];

    // Relationships
    public function children(): HasMany
    {
        return $this->hasMany(Galeri::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Galeri::class, 'parent_id');
    }

    // Scope untuk filter kategori
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    // Scope untuk filter album
    public function scopeAlbum($query, $album)
    {
        return $query->where('album', $album);
    }

    // Scope untuk filter aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk parent records only
    public function scopeParents($query)
    {
        return $query->where('is_parent', true);
    }

    // Scope untuk child records only
    public function scopeChildren($query)
    {
        return $query->whereNotNull('parent_id');
    }

    // Scope untuk order by tanggal terbaru
    public function scopeLatestDate($query)
    {
        return $query->orderBy('tanggal', 'desc');
    }

    // Helper method to get all images (parent + children)
    public function getAllImages()
    {
        if ($this->is_parent) {
            return collect([$this])->merge($this->children);
        }
        return collect([$this]);
    }
}
