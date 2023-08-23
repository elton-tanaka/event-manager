<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Helper\ImageHelper;

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
            $imagePath = public_path('img/events') . $fileName;
            Storage::disk('public')->put($imagePath, File::get($file));
            $formInput['image'] = $imagePath;
        }

        $user = auth()->user();
        $formInput['user_id'] = $user->id;

        // echo("<script>console.log('" . var_dump($formInput) . "');</script>");
        Event::create($formInput);

        return redirect('/')->with('success', 'Event created successfully');
    }

    public function show(Event $event) {
        return view('events.show', compact('event'));
    }

    public function edit(Event $event) {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event) {
        $request->validate([
            'title' => 'required|unique:events,title|max:255' . $event->id,
            'description' => 'required',
            'date' => 'required',
            'city' => 'required|max:255'
        ]);
        $formInput = $request->all();

        if($file = $request->file('image')) {
            $fileName = time() . $file->getClientOriginalName();
            $imagePath = public_path('img/events') . $fileName;
            Storage::disk('public')->put($imagePath, File::get($file));
            $formInput['image'] = $imagePath;
        } else {
            unset ($formInput['image']);
        }

        $event->update($formInput);

        return redirect('/')->with('success', 'Event updated successfully');
    }

    public function destroy(Event $event) {
        $event->delete();

        return redirect('/')->with('success', 'Event deleted successfully');
    }
}
