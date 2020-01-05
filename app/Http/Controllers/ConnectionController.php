<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Connection;
use Illuminate\Support\Facades\Auth;


class ConnectionController extends Controller
{
    public function index() 
    {
        $connections = Connection::where('request_to', Auth::user()->id)->get();
        return view('connections.index', ['connections' => $connections]);
    }
}
