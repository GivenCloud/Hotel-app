<?php

namespace App\Models\ManyToMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelService extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'hotel_id', 'service_id'];

}
