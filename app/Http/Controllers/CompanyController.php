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
    public function form()
    {
        return view('admin.company', ['companies' => Company::with('tags')->get(), 'tags' => Tag::get()]);
    }
    public function create(Request $request)
    {
        if ($request->input("name") && $request->input("description") && $request->input("image") && $request->input("tags")) {
            Tag::create([
                'name' => $request->input("name"),
                'description' => $request->input("description"),
                'image' => $request->input("image"),
                'tags' => $request->input("tags"),
            ]);
        }
        return redirect()->back();
    }
}
