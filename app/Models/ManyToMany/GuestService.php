<?php

namespace App\Models\ManyToMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestService extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'guest_id', 'service_id'];

}
