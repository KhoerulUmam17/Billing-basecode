<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function product_group()
    {
        return $this->belongsTo(ProdukGroup::class, 'product_group_id');
    }

    public function module()
    {
        return $this->belongsTo(ProdukModule::class, 'module_id');
    }

    public function taxes()
    {
        return $this->belongsToMany(Tax::class, 'product_tax');
    }

    protected $fillable = [
        'product_group_id',
        'product_code',
        'name',
        'slug',
        'description',
        'type',
        'module_id',
        'image',
        'status',
        'is_hidden',
        'tax_type',
        'payment_type',
    ];

    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
