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
            'received_at' => 'datetime',
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
