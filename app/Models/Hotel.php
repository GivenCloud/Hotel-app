<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'adress', 'phone', 'email', 'website'];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'hotel_service');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
