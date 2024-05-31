<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solved extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "variant_id",
        "result",
        "created_at",
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }
}
