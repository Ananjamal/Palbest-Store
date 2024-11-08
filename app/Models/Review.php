<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'reviews';

    // Define fillable properties to protect against mass-assignment vulnerabilities
    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
        'review',
    ];

    // Define relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
