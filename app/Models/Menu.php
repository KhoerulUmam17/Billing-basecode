<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'slug', 'icon', 'route', 'order'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'menu_user')->withPivot('active')->withTimestamps();
    }

    public function roleMenus()
    {
        return $this->hasMany(RoleMenu::class, 'menu', 'slug');
    }
}
