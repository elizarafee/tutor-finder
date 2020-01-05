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

    public function store($request_to)
    {
        $connection_data = array(
            'request_to' => $request_to,
            'requested_by' => Auth::user()->id,
        );

        $connection = Connection::create($connection_data);

        if($connection) {
            return redirect()->back()->with('success', 'Connection request successfully sent.');
        }

        return redirect()->back()->with('error', 'Failed to send the request. Please try again.');
    }
}
