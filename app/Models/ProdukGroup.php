<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukGroup extends Model
{
    protected $table = 'product_groups';
    protected $fillable = ['name', 'description', 'url'];

    public function paymentGateways()
    {
        return $this->belongsToMany(PaymentGateway::class, 'payment_gateway_product_group', 'product_group_id', 'payment_gateway_id');
    }
}
