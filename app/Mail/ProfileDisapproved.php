<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProfileDisapproved extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Tutor Finder - Profile Disapproved')
            ->markdown('emails.profiles.disapproved')
            ->with(
                [
                    'first_name' => $this->user->first_name,
                    'url' => url('/login'),
                    'reason' => $this->user->rejection_reason
                ]
            );
    }
}
