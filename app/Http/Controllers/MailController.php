<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests;
use Illuminate\Support\Str;

class MailController extends Controller {
    public function basic_email(Request $request) {
        $random = Str::random(4);
        echo $random;
        $contactMessage="Kod:".$random;
        $emailTo=$request->email;
        Mail::raw($contactMessage, function ($message) use ($emailTo) {

            $message->from('pavle.cvorovic@gmail.com', 'Verifikacija');
            $message->to($emailTo);
            $message->subject('Poslato sa BalkaZone.me');

        });


        echo "Basic Email Sent. Check your inbox.";
    }
}
