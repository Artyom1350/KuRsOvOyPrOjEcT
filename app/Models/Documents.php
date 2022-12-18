<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;

    protected $fillable=['file','title','description'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
