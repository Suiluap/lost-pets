<?php

namespace App\Models;

use App\Models\User;
use App\Models\Report;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    protected $fillable = [
        'text',
        'user_id',
        'report_id'
    ];

    public function ownedByUser() {
        return auth()->user()->id == $this->user_id;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function report() {
        return $this->belongsTo(Report::class);
    }
}
