<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'adress', 'phone', 'email', 'website'];

    public function rooms()
    {
        return $this->hasOne(Room::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
