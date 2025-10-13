<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['name', 'email', 'designation', 'base_salary'];

    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }
}
