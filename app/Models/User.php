<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
// <--- WAJIB ADA AGAR TIDAK ERROR

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // Scope untuk search
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%");
    }

    // Helper untuk ambil URL foto
    public function getProfilePictureUrl()
    {
        // Jika ada profile picture di database
        if ($this->profile_picture) {
            // Cek format: "profile_pictures/filename.png" atau hanya "filename.png"
            $filePath = $this->profile_picture;

            // Jika tidak ada prefix "profile_pictures/", tambahkan
            if (! str_contains($filePath, 'profile_pictures/')) {
                $filePath = 'profile_pictures/' . $filePath;
            }

            // Pastikan file ada
            if (Storage::disk('public')->exists($filePath)) {
                return Storage::url($filePath);
            }
        }

        // Fallback ke avatar API
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=009CFF&color=fff&size=150';
    }
}
