<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestAccepted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $accepted_by)
    {
        $this->user = $user;
        $this->accepted_by = $accepted_by;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('Tutor Finder - Request accepted')
            ->markdown('emails.requests.accepted')
            ->with(
                [
                    'first_name' => $this->user->first_name,
                    'accepted_by' => $this->accepted_by
                ]
            );

    }
}
