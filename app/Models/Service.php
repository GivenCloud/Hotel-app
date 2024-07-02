<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'description', 'category_id'];

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_services');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function guests()
    {
        return $this->belongsToMany(Guest::class, 'guest_services');
    }
}
