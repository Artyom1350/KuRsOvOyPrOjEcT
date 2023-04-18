<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class SendMailController extends Controller
{
    public function send(){
        $toMail="cursovoyusertest@gmail.com";
        $mm = new SendMail('Oleg)))))))))');
        Mail::to($toMail)->send($mm);

        return 'Mail has been send';
    }
}
