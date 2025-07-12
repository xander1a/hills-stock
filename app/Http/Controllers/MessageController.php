<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function index()
    {
        // Logic to show messages
        return view('messages.index');
    }
}
