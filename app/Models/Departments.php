<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    use HasFactory;

    $fillable=['name'];

    public function departmentsParts(){
        return $this->hasMany(DepartmentsParts::class);
    }
}
