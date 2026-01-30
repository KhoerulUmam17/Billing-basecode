<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'code', 'prefix', 'suffix', 'format', 'base_rate'
    ];
}
