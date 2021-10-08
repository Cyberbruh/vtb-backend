<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;
use App\Models\Tag;

class CompanyController extends Controller
{
    public function get(Request $request)
    {
        return Company::with('tags')->get();
    }
}
