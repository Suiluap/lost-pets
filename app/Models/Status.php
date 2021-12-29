<?php

namespace App\Models;

use App\Models\Report;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function reports() {
        return $this->hasMany(Report::class);
    }
}
