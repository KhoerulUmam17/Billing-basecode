<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    protected $table = 'role_menu';
    protected $fillable = ['role', 'menu', 'can_access'];
    public $timestamps = false;

    public function role()
    {
        return $this->belongsTo(Role::class, 'role', 'name');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu', 'slug');
    }
}
