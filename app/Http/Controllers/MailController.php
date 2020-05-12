<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{

    public static function sendRequest($name,$phone) 
        {

        $data = array('name'=>$name, "body" => $phone);

        Mail::send('mail.request', $data, function($message) 
            use ($name) {
        
            $message->to(env('EMAIL_TO'), $name)
            ->subject('Заявка на консультацию');

            $message->from(env('EMAIL_FROM'), 'Вкусняшки от Торяшки');
        
        });
    }

    public static function sendOrders($name, $phone, 
    $message, $sum) 
        {

        $data = array('name'=>$name, "body" => $message, 
        'phone' => $phone, 'sum' => $sum);

        Mail::send('mail.oreders', $data, function($message) use ($name) {
        
            $message->to(env('EMAIL_TO'), $name)
            ->subject('Заказ');

            $message->from(env('EMAIL_FROM'), 'Вкусняшки от Торяшки');
        
        });
    }

   
}
