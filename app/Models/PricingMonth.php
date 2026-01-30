<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingMonth extends Model
{
    use HasFactory;
    protected $table = 'pricing_months';
    protected $primaryKey = 'id_pricingmonth';
    protected $fillable = ['fee', 'status'];
}
