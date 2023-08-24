<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Helper\ImageHelper;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index() {
        $search = request('search');

        if($search) {

            $events = Event::where([
                ['title', 'like', '%'.$search.'%']
            ])->get();

        } else {
            $events = Event::all();
        }

        return view('welcome',['events' => $events, 'search' => $search]);
    }

    public function create() {
        return view('events.create');
    }

    public function store(Request $request) {

        $request->validate([
            'title' => 'required|unique:events,title|max:255',
            'description' => 'required',
            'date' => 'required',
            'city' => 'required|max:255',
            'items' => 'nullable|array',
            'image' => 'nullable|image|max:2048'
        ]);


        $formInput = $request->all();

        $formInput['promoted'] = $request->input('promoted') ? true : false;
        if($file = $request->file('image')) {
            $fileName = time() . $file->getClientOriginalName();
            $file->move(public_path('img/events'), $fileName);
            $formInput['image'] = $fileName;
        }

        $user = auth()->user();
        $formInput['user_id'] = $user->id;

        Event::create($formInput);

        return redirect('/')->with('success', 'Event created successfully');
    }

    public function show(Event $event) {


        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', compact('event', 'eventOwner'));
    }

    public function edit(Event $event) {
        return view('events.edit', compact('event'));
    }

    public function update(Event $event, Request $request) {
        $request->validate([
            'title' => 'required|max:255|unique:events,title,' . $event->id,
            'description' => 'required',
            'date' => 'required',
            'city' => 'required|max:255'
        ]);
        $formInput = $request->all();
        $formInput['promoted'] = $request->input('promoted') ? true : false;
        if($file = $request->file('image')) {
            $fileName = time() . $file->getClientOriginalName();
            $file->move(public_path('img/events'), $fileName);
            $formInput['image'] = $fileName;
        }
        $event->update($formInput);

        return redirect('/')->with('success', 'Event updated successfully');
    }

    public function destroy(Event $event) {
        $event->delete();

        return redirect('/')->with('success', 'Event deleted successfully');
    }

    public function dashboard() {

        $user = auth()->user();

        $events = $user->events;

        // $eventsAsParticipant = $user->eventsAsParticipant;

        // return view('events.dashboard', compact(['events', 'eventsasparticipant']));

        return view('events.dashboard', compact(['events']));

    }
}
