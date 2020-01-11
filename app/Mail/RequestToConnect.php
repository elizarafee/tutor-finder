<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestToConnect extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $requested_by)
    {
        $this->user = $user;
        $this->requested_by = $requested_by;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->subject('Tutor Finder - Request to connect')
            ->markdown('emails.requests.connect')
            ->with(
                [
                    'first_name' => $this->user->first_name,
                    'requested_by' => $this->requested_by,
                ]
            );

    }
}
