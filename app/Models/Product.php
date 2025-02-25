<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'category', // Ensure `category` is fillable
        'price',
        'short_description',
        'long_description',
        'image',
        'stock',
        'status',
        'seo_tags',
    ];
}
