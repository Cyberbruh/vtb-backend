<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function form()
    {
        return view('admin.tag', ['tags' => Tag::get()]);
    }

    public function create(Request $request)
    {
        if ($request->input("name"))
            Tag::create([
                'name' => $request->input("name"),
            ]);
        return redirect()->back();
    }
}
