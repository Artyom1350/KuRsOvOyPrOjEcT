<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable=['file','title','description','path','user_id','dateAppl'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function access_users(){
        return $this->hasMany(AccessUser::class);
    }
}
