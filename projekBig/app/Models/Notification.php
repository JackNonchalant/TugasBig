<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'user_id',
        'title',
        'message',
        'type',
        'related_type',
        'related_id',
        'read_at',
    ];

    protected function casts(): array
    {
        return [
            'read_at' => 'datetime',
        ];
    }

    /**
     * Relasi ke pengguna penerima notifikasi.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Cek apakah notifikasi sudah dibaca.
     */
    public function isRead(): bool
    {
        return $this->read_at !== null;
    }

    /**
     * Tandai sebagai sudah dibaca.
     */
    public function markAsRead(): void
    {
        if (!$this->isRead()) {
            $this->update(['read_at' => now()]);
        }
    }

    /**
     * Scope: notifikasi yang belum dibaca.
     */
    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }
}
