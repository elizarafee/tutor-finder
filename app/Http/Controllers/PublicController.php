<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendMailRequest;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendContactMail;

/**
 * Takes care of all the public pages
 */

class PublicController extends Controller
{
    /**
     * Show the home page
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('home');
    }

    /**
     * Show the about page
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Show the terms of use page
     *
     * @return \Illuminate\Http\Response
     */
    public function termsOfUse()
    {
        return view('terms-of-use');
    }

    /**
     * Show the contact page
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Send mail to admin
     *
     * @param  App\Http\Requests\SendMailRequest $request;
     * @return Illuminate\Support\Facades\Redirect
     */
    public function sendContact(SendMailRequest $request)
    {
        try {
            $contact = array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'msg' => $request->get('message')
            );

            Mail::to(developer('email'))->send(new SendContactMail($contact));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send the message. Please try again.');
        }

        return redirect()->back()->with('success', 'Message sent successfully.');
    }
}
