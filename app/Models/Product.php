<?php

namespace App\Models;

use App\Models\CartItem;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Inventory;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description','image' ,'price', 'size', 'color', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    public function favorite()
    {
        return $this->hasMany(Favorite::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}