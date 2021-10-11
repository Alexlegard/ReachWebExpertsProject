<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Order;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;
	
	public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		//return $this->to('alexlegard3@gmail.com', 'Alex')
		//	->subject('Subject line')
		//	->view('emails.orders.placed');

        return $this->subject('Subject line')
          ->view('emails.orders.placed');
    }
}
