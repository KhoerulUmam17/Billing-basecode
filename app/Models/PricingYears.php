<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingYears extends Model
{
    use HasFactory;
    protected $table = 'pricing_years';
    protected $primaryKey = 'id_pricingyears';
    protected $fillable = ['fee', 'status'];
}
