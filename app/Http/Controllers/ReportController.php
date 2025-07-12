<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index()
    {
        // Logic to show reports
        return view('reports.index');
    }
}
