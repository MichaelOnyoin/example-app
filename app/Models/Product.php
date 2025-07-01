<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Product extends Model
{
    //
    use HasFactory, Notifiable, HasApiTokens;
    protected $fillable = [
        'price',
        'originalPrice',
        'discount',
        'title',
        'description',
        'imageUrl',
        'brand',
        'category',
        'type',
        'deals',
        // 'liked', // Uncomment if you want to track liked status
    ];

    public $timestamps = false; // Set to true if you want to use created_at and updated_at timestamps
}
