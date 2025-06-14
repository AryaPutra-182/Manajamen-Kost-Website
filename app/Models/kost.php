<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kost extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'address',
        'price',
        'image',
        'status_ketersediaan'
    ];
    public  function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
