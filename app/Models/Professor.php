<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
