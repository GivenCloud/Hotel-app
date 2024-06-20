<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'description', 'category'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
