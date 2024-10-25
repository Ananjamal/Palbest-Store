<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingDetail extends Model
{
    use HasFactory;
    protected $fillable = ['order_id','shipping_first_name', 'shipping_last_name', 'shipping_email', 'shipping_phone', 'shipping_address','shipping_city','shipping_zip','shipping_country','shipping_state'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
