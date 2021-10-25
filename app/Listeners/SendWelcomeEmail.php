<?php

namespace App\Listeners;

use App\Events\NewUserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SendWelcomeEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewUserRegistered  $event
     * @return void
     */
    public function handle(NewUserRegistered $event)
    {
        $user = $event->user;
        Mail::send('welcome', ['user' => $user], function ($message) use ($user) {
                $message->from('patatereine7@hotmail.fr', 'Quiz de Noël');
                $message->subject('Bienvenue au Quiz de Noël 🎄 '.$user->name.'!');
                $message->to($user->email);
        });
    }
}
