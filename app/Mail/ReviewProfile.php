<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReviewProfile extends Mailable
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
        $type = '';
        $user_type = $this->user->type;
        if($user_type == 2) {
            $type = 'Tutor';
        } elseif($user_type == 3) {
            $type = 'Student';
        }

        return $this->subject('Tutor Finder - Profile Review')
            ->markdown('emails.profiles.review')
            ->with(
                [
                    'full_name' => $this->user->first_name . ' ' . $this->user->last_name,
                    'type' => $type,
                ]
            );
    }
}
