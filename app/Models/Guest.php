<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'lastName', 'dniPassport', 'email', 'phone', 'checkInDate', 'checkOutDate'];

    public function rooms() {
        return $this->belongsToMany(Room::class, 'room_guests');
    }

    public function services() {
        return $this->belongsToMany(Service::class, 'guest_services');
    }
}
