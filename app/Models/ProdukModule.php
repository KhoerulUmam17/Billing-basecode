<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukModule extends Model
{
    protected $table = 'modules';
    protected $fillable = ['name', 'description'];
}
