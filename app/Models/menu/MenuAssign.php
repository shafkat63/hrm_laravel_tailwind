<?php

namespace App\Models\menu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuAssign extends Model
{
    use HasFactory;
    protected $table = 'menu_assign';

    protected $fillable = [
        'menu_id',
        'role',
        'status',
        'create_by',
        'create_date',
        'update_by',
        'update_date'
    ];

    
}
