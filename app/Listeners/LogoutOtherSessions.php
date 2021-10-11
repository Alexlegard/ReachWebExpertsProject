<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Auth;

class LogoutOtherSessions
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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        if ($event->guard == 'web') {
            Auth::guard('admin')->logout();
            Auth::guard('superadmin')->logout();
        }

        if ($event->guard == 'admin') {
            Auth::logout();
            Auth::guard('superadmin')->logout();
        }

        if ($event->guard == 'superadmin') {
            Auth::logout();
            Auth::guard('admin')->logout();
        }
    }
}
