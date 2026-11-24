<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Notifikasi extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'notifikasi_id';

    protected $fillable = [
        'user_id',
        'judul_notifikasi',
        'pesan',
        'status_baca',
    ];

    public $timestamps = false; // Assuming created_at handled manually

    protected $dates = ['created_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
