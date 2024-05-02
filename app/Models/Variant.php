<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;
    protected $fillable = [
        "file",
        "answers",
        "subject",
        "created_at"
    ];
    public function solved(){
        return $this->belongsTo(Solved::class);
    }
}
