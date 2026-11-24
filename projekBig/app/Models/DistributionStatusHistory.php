<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributionStatusHistory extends Model
{
    use HasFactory;

    protected $table = 'distribution_status_histories';

    protected $fillable = [
        'distribution_id',
        'status_before',
        'status_after',
        'catatan',
        'nomor_resi',
        'changed_by',
    ];

    /**
     * Relasi ke distribusi.
     */
    public function distribution()
    {
        return $this->belongsTo(Distribution::class, 'distribution_id');
    }

    /**
     * Relasi ke petugas yang mengubah status.
     */
    public function changedByUser()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
