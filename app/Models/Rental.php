<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        
        'startDate',
        'endDate',
        'totalPrice',
        'user_id',
        'equipment_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class,'equipment_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
