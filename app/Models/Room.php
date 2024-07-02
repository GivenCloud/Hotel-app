<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'number', 'type_id', 'hotel_id'];

    public function guests() {
        return $this->belongsToMany(Guest::class, 'room_guests');
    }

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function hotel() {
        return $this->belongsTo(Hotel::class);
    }
}
