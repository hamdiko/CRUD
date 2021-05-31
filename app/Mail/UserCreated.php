<?php

namespace App\Mail;

use App\Registrant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserCreated extends Mailable
{
    use Queueable, SerializesModels;
	public $registrant;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Registrant $registrant)
    {
        $this->registrant = $registrant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
    	
    	return $this->from('hamdy.soubhy@gmail.com')->view('emails.users.created');
    }
}
