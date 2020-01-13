<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * Send me to admin 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Redirect 
     */
    public function sendContact(Request $request)
    {
        echo "<pre>";
        print_r($request->all());
        echo "</pre>";
    }
}
