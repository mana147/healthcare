<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Mail;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class JobMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mail;

    public function __construct($mail)
    {
        $this->mail = $mail;
    }

    public function handle(Request $request)
    {
        Mail::send(
            'pages.mail.blanks', // view gửi mail
            $this->mail,
            function($m) use ($request) {
                $m->to($request->txtEmail, 'Visitor')->subject('KEY ACTIVE'); 
            }
        );

        // $key = Str::random(5);
        // $data = ['key' => $key];
        
        // Mail::send(
        //     'pages.mail.blanks', // view gửi mail
        //     $data,
        //     function($m) use ($request) {
        //         $m->to($request->txtEmail, 'Visitor')->subject('KEY ACTIVE'); 
        //     }
        // );


    }
}
