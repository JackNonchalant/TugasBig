<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    use HasFactory;

    protected $table = 'distributions';

    protected $fillable = [
        'donation_item_id',
        'beneficiary_id',
        'status',
        'catatan',
        'nomor_resi',
        'processed_by',
        'distributed_at',
    ];

    protected function casts(): array
    {
        return [
            'distributed_at' => 'datetime',
        ];
    }

    /**
     * Status yang valid dan transisi yang diperbolehkan.
     */
    public const STATUSES = [
        'Menunggu Penyaluran',
        'Dalam Proses Penyaluran',
        'Disalurkan',
    ];

    public const VALID_TRANSITIONS = [
        'Menunggu Penyaluran' => ['Dalam Proses Penyaluran'],
        'Dalam Proses Penyaluran' => ['Disalurkan'],
        'Disalurkan' => [],
    ];

    /**
     * Cek apakah transisi status valid.
     */
    public function canTransitionTo(string $newStatus): bool
    {
        $allowed = self::VALID_TRANSITIONS[$this->status] ?? [];
        return in_array($newStatus, $allowed, true);
    }

    /**
     * Relasi ke barang donasi.
     */
    public function donationItem()
    {
        return $this->belongsTo(DonationItem::class, 'donation_item_id');
    }

    /**
     * Relasi ke penerima manfaat.
     */
    public function beneficiary()
    {
        return $this->belongsTo(User::class, 'beneficiary_id');
    }

    /**
     * Relasi ke admin/petugas yang memproses.
     */
    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    /**
     * Relasi ke histori perubahan status.
     */
    public function statusHistories()
    {
        return $this->hasMany(DistributionStatusHistory::class, 'distribution_id')->orderBy('created_at', 'desc');
    }

    /**
     * Relasi ke bukti foto serah terima.
     */
    public function proofs()
    {
        return $this->hasMany(DistributionProof::class, 'distribution_id');
    }

    /**
     * Label warna badge status.
     */
    public function getStatusBadgeAttribute(): array
    {
        return match ($this->status) {
            'Menunggu Penyaluran' => ['color' => 'amber', 'icon' => 'clock'],
            'Dalam Proses Penyaluran' => ['color' => 'blue', 'icon' => 'truck'],
            'Disalurkan' => ['color' => 'emerald', 'icon' => 'check'],
            default => ['color' => 'slate', 'icon' => 'info'],
        };
    }
}
