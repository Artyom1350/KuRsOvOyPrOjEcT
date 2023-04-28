<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\SendMailForUsers;



class EmailSender extends Model
{
    use HasFactory;

    static function sendEmail($docTitle, $email){
        $mm = new SendMail($docTitle);
        Mail::to($email)->send($mm);
        return 'Mail has been send';

    }
    static function sendEmailForUsers($docTitle,$email,$docId){
        $mm = new SendMailForUsers($docTitle,$docId);
        Mail::to($email)->send($mm);
        return 'Mail has been send';
    }
}
