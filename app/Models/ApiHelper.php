<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\PersonalAccessToken;

class ApiHelper extends Model
{
    use HasFactory;

    static function tokenProv($token){
        $token = PersonalAccessToken::where('token', $token)->first();
        if($token!=null){
            return true;
        }
        return;

    }
    protected function isUser($user): bool
    {
        if (!empty($user)) {
            return $user->tokenCan('user');
        }
        return false;
    }
}
