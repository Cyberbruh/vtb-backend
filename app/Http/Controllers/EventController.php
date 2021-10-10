<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\Tag;

class EventController extends Controller
{
    public function generate(Request $request)
    {
        $sum_tickets = Event::sum('probability');
        $ticket = rand(0, $sum_tickets - 1);
        $events = Event::with('tags')->get();
        $event = null;
        $sum = 0;
        foreach ($events as $i) {
            if ($sum <= $ticket && $ticket <= $sum + $i->probability) {
                $event = $i;
                break;
            }
            $sum += $i->probability;
        }
        if (!$event)
            return response()->json("Zero events in db", 400);
        $changes = [];
        foreach ($event->tags()->get() as $tag) {
            foreach ($tag->companies()->get() as $company) {
                array_push($changes, [
                    "company_id" => $company->id,
                    "change" => $tag->pivot->change,
                ]);
            }
        }
        if ($request->user()->experience != 2)
            $difficulty = 0;
        else
            $difficulty = 1;
        if ($difficulty)
            $result = [
                "title" => $event->title,
                "text" => $event->text,
                "image" => $event->image,
                "changes" => $changes,
            ];
        else
            $result = [
                "title" => $event->title,
                "text" => $event->text,
                "solution" => $event->solution,
                "image" => $event->image,
                "changes" => $changes,
            ];
        return $result;
    }
    public function form()
    {
        return view('admin.event', ['events' => Event::with('tags')->get(), 'tags' => Tag::get(), 'sum_tickets' => Event::sum('probability')]);
    }
    public function create(Request $request)
    {
        if ($request->input("title") && $request->input("text") && $request->input("probability") && $request->input("image") && $request->input("solution") && $request->input("tags")) {
            $event = Event::create([
                'title' => $request->input("title"),
                'text' => $request->input("text"),
                'probability' => $request->input("probability"),
                'image' => $request->input("image"),
                'solution' => $request->input("solution"),
            ]);
            foreach ($request->input("tags") as $tag) {
                $event->tags()->attach($tag, ["change" => $request->input("change" . $tag)]);
            }
        }
        return redirect()->back();
    }
    public function delete(Request $request, Event $event)
    {
        $event->delete();
        return redirect()->back();
    }
}
