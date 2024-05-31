<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "city",
        "adres",
    ];

    public function school_items()
    {
        return $this->hasMany(SchoolItems::class);
    }
}
