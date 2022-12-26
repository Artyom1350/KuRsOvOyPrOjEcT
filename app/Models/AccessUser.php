<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessUser extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    //public function document($id){
    //    $da=Document::where('id',$id);
    //    return $da;
    //    //return $this->belongsTo(Documents::class);
    //}

    public function document(){
        $da=$this->belongsTo(Document::class);
        return $da;
    }
}
