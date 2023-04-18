<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;



class EmailSender extends Model
{
    use HasFactory;

    static function sendEmail($docTitle){
        $toMail="cursovoyusertest@gmail.com";
        $mm = new SendMail($docTitle);
        Mail::to($toMail)->send($mm);

        return 'Mail has been send';

    }
}
