<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;
use App\Models\Event;

class MainController extends Controller
{
    public function index()
    {
        return view('index');
    }
}
