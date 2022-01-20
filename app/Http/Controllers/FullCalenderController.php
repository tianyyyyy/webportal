<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class FullCalenderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                ->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
        }

        $events = Event::orderBy('start', 'ASC')->paginate(10);

        return view('admin.events.index', ['events' => $events]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'start' => 'required',
            'end' => 'required',
            'venue' => 'required',
        ]);

        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'start' => $request->start,
            'end' => $request->end,
            'status' => $request->status,
            'venue' => $request->venue
        ]);

        return back()->with('message', 'You Created an event!');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return back()->with('message', 'The event has been deleted');
    }

    public function status($id)
    {
        $event = Event::find($id);

        if ($event->status === 0) {
            $event->status = 1;
            $event->save();
        } else {
            $event->status = 0;
            $event->save();
        }
        return back()->with('message', 'Event has been archive');
    }
}
