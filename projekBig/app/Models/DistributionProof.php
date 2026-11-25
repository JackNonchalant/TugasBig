<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributionProof extends Model
{
    use HasFactory;

    protected $table = 'distribution_proofs';

    protected $fillable = [
        'distribution_id',
        'foto_path',
        'original_name',
        'uploaded_by',
    ];

    /**
     * Relasi ke distribusi.
     */
    public function distribution()
    {
        return $this->belongsTo(Distribution::class, 'distribution_id');
    }

    /**
     * Relasi ke petugas yang mengunggah.
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Helper untuk mendapatkan URL foto.
     */
    public function getFotoUrlAttribute(): string
    {
        return asset('storage/' . $this->foto_path);
    }
}
