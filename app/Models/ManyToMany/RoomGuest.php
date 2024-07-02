<?php

namespace App\Models\ManyToMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomGuest extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'room_id', 'guest_id'];

}
