<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessUser extends Model
{
    use HasFactory;

    protected $fillable=['document_id','user_id','status'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function document(){
        $da=$this->belongsTo(Document::class);
        return $da;
    }
}
