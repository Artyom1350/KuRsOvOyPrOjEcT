<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentPart extends Model
{
    use HasFactory;

    $fillable=['name'];

    public function department(){
        return $this->belongsTo(Departments::class);
    }
    public function users(){
        return $this->hasMany(Users::class);
    }

}
