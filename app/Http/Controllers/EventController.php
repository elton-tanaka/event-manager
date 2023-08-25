<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\EventRepositoryInterface;

class EventController extends Controller
{
    private $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository) {
        $this->eventRepository = $eventRepository;
    }

    public function index() {
        $search = request('search');

        $events = $this->eventRepository->allEvents()->sortByDesc('promoted');

        if($search) {
            $events = $events->where(function ($query) use ($search) {
                $query->where('title', 'like', '%'.$search.'%')->get();
            });

            // $events = $events->where('title', 'like', '%'.$search.'%');
            dd($events);
        }

        // return view('welcome',['events' => $events, 'search' => $search]);
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
        $user = auth()->user();

        if($user) {
            $userEvents = $user->eventsAsParticipant->toArray();
            $hasUserJoined = false;
            foreach($userEvents as $userEvent) {
                $hasUserJoined = ($event->id == $userEvent['id']) ? true : false;
                break;
            }
        }

        return view('events.show', compact('event', 'eventOwner', 'hasUserJoined'));
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
        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard', compact('events', 'eventsAsParticipant'));

    }

    public function joinEvent(int $id) {
        $user = auth()->user();
        $user->eventsAsParticipant()->attach($id);
        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('success', 'Sua presença está confirmada no evento ' . $event->title);
    }

    public function leaveEvent(int $id) {
        $user = auth()->user();
        $user->eventsAsParticipant()->detach($id);
        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('success', 'Você saiu com sucesso do evento: ' . $event->title);

    }
}
