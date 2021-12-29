<?php

namespace App\Models;

use App\Models\User;
use App\Models\Status;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'picture',
        'description',
        'date',
        'address',
        'user_id',
        'status_id'
    ];

    public function ownedByUser() {
        return auth()->user()->id == $this->user_id;
    }

    public function savedByUser()
    {
        return $this->saves->contains('user_id', Auth::user()->id);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function saves() {
        return $this->hasMany(Save::class);
    }
}
