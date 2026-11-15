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
        'category_id',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class,'category_id');
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
