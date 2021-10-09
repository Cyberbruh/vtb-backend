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
        if ($request->input("name") && $request->input("description") && $request->input("image") && $request->input("rate") && $request->input("tags")) {
            $company = Company::create([
                'name' => $request->input("name"),
                'description' => $request->input("description"),
                'image' => $request->input("image"),
                'rate' => $request->input("rate"),
            ]);
            $company->tags()->attach($request->input("tags"));
        }
        return redirect()->back();
    }
    public function delete(Request $request, Company $company)
    {
        $company->delete();
        return redirect()->back();
    }
}
