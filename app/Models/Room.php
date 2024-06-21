<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'number', 'type', 'price'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function guest() {
        return $this->hasMany(Guest::class);
    }
}
