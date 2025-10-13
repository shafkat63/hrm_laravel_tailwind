<?php

namespace App\Models\menu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    use HasFactory;
    protected $table = 'menu';
    public $timestamps = false;

    protected $fillable = ['parent_id', 'title', 'desc', 'url', 'icon', 'status', 'create_by', 'update_by','create_date','update_date'];

    // Define the relationship for child menus (submenus)
    public function submenu()
    {
        return $this->hasMany(MenuModel::class, 'parent_id');
    }

    // Define the relationship for the parent menu
    public function parent()
    {
        return $this->belongsTo(MenuModel::class, 'parent_id');
    }
}
