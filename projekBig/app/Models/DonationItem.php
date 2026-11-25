<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationItem extends Model
{
    use HasFactory;

    protected $table = 'donation_items';

    protected $fillable = [
        'user_id',
        'nama_barang',
        'kategori',
        'deskripsi',
        'kondisi',
        'jumlah',
        'foto',
        'lokasi_posko',
        'jadwal_penyerahan',
        'status',
        'recipient_name',
        'recipient_contact',
        'recipient_address',
        'received_at',
        'receipt_photo',
        'receipt_document',
        'distribution_notes',
    ];

    protected function casts(): array
    {
        return [
            'jumlah' => 'integer',
        ];
    }

    /**
     * Get the donor (user) who posted this donation item.
     */
    public function donor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get distributions for this donation item.
     */
    public function distributions()
    {
        return $this->hasMany(Distribution::class, 'donation_item_id');
    }

    /**
     * Get the latest/active distribution.
     */
    public function latestDistribution()
    {
        return $this->hasOne(Distribution::class, 'donation_item_id')->latestOfMany();
    }

    /**
     * Scope: hanya barang yang aktif/tersedia untuk ditampilkan di katalog (PBI-008).
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'tersedia')
                     ->where('jumlah', '>', 0);
    }

    /**
     * Scope: pencarian aman berdasarkan nama_barang atau deskripsi (PBI-007).
     * Menggunakan parameter binding Eloquent dan escaping wildcard LIKE.
     */
    public function scopeSearch($query, ?string $keyword)
    {
        $keyword = trim((string) $keyword);

        if ($keyword === '') {
            return $query;
        }

        $escaped = addcslashes($keyword, '\\%_');
        $pattern = '%' . $escaped . '%';

        return $query->where(function ($q) use ($pattern) {
            $q->where('nama_barang', 'like', $pattern)
              ->orWhere('deskripsi', 'like', $pattern);
        });
    }

    /**
     * Helper to get public URL of the item photo.
     */
    public function getFotoUrlAttribute(): ?string
    {
        if (!$this->foto) {
            return null;
        }

        if (str_starts_with($this->foto, 'http://') || str_starts_with($this->foto, 'https://')) {
            return $this->foto;
        }

        return asset('storage/' . $this->foto);
    }
}
