<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifySubordinates extends Mailable
{
    use Queueable, SerializesModels;

    public $name;

    public $subordinateName;
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $subordinateName, $name )
    {
        $this->name = $name;
        
        $this->subordinateName = $subordinateName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.notify_subordinates')
                    ->subject('Your manager has new subordinate');
    }
}
