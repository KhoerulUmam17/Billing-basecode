<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'description', 'active'
    ];

    public function productGroups()
    {
        return $this->belongsToMany(ProdukGroup::class, 'payment_gateway_product_group', 'payment_gateway_id', 'product_group_id');
    }
}
