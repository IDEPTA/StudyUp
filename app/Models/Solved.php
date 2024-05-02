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
    public function user(){
        $this->hasMany(User::class);
    }
    public function variant(){
        $this->hasMany(Solved::class);
    }
}
