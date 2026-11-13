<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    //
     use HasFactory;
     
    protected $fillable = [
        'name',
        'description',
        'dailyPrice',
        'categorie_id',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
