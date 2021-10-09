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
    public function admin()
    {
        return view('admin.index');
    }
    public function admin_login(Request $request)
    {
        if ($request->input('key') == env('ADMIN_PASSWORD')) {
            session(['admin' => 'true']);
            return redirect()->route('admin.index');
        }
        return "";
    }
}
