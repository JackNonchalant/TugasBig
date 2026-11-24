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
        'alasan_penolakan',
    ];

    protected function casts(): array
    {
        return [
            'jumlah' => 'integer',
            'jadwal_penyerahan' => 'date',
        ];
    }

    /**
     * Daftar lokasi posko transit resmi PojokBerbagi yang dapat dipilih.
     */
    public static function getPoskoTransitList(): array
    {
        return [
            'Posko Transit Pusat (Jl. Pendidikan No. 45, Bandung)',
            'Posko Transit Dago (Jl. Ir. H. Juanda No. 120, Bandung)',
            'Posko Transit Buah Batu (Jl. Buah Batu No. 88, Bandung)',
            'Posko Transit Sukajadi (Jl. Sukajadi No. 15, Bandung)',
            'Posko Transit Cibiru (Jl. A.H. Nasution No. 102, Bandung)',
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
