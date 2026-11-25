<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_lengkap',
        'email',
        'password_hash',
        'no_telepon',
        'role',
        'alamat',
        'status_akun',
    ];

    /**
     * Get donation items posted by this user.
     */
    public function donationItems()
    {
        return $this->hasMany(DonationItem::class, 'user_id');
    }

    /**
     * Get notifications for this user.
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id')->orderBy('created_at', 'desc');
    }

    /**
     * Get unread notifications count.
     */
    public function unreadNotificationsCount(): int
    {
        return $this->notifications()->whereNull('read_at')->count();
    }

    /**
     * Check if user is a donor.
     */
    public function isDonor(): bool
    {
        return $this->role === 'donor';
    }

    /**
     * Check if user is a beneficiary.
     */
    public function isBeneficiary(): bool
    {
        return $this->role === 'beneficiary';
    }

    /**
     * Check if user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
