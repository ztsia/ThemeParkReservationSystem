<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'normalPrice',
        'childrenSeniorPrice',
        'studentPrice',
    ];
    use HasFactory;

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
