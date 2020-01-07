<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProfileApproved extends Mailable
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
            $type = 'Students';
            $url = url('/students');
        } elseif($user_type == 3) {
            $type = 'Tutors';
            $url = url('/tutors');
        }

        return $this->subject('Tutor Finder - Profile Approved')
            ->markdown('emails.profiles.approved')
            ->with(
                [
                    'first_name' => $this->user->first_name,
                    'url' => $url,
                    'user_type' => $type,
                ]
            );

    }
}
