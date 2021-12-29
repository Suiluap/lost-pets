<?php

namespace App\Models;

use App\Models\Save;
use App\Models\Report;
use App\Models\Comment;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'town',
        'password',
        'role'
    ];

    public function reports() {
        return $this->hasMany(Report::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function saves() {
        return $this->hasMany(Save::class);
    }

    public function isAdmin() {
        return $this->role == 'admin';
    }
}
