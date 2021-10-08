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
        $ticket = rand(1, $sum_tickets);
        $events = Event::with('tags')->get();
        $event = null;
        $sum = 0;
        foreach ($events as $i) {
            if ($sum <= $ticket && $ticket <= $sum + $i->probability) {
                $event = $i;
                break;
            }
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
        $result = [
            "title" => $event->title,
            "text" => $event->text,
            "changes" => $changes,
        ];
        return $result;
    }
}
