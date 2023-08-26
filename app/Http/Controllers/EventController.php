<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\EventRepositoryInterface;
use Exception;

class EventController extends Controller
{
    private $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository) {
        $this->eventRepository = $eventRepository;
    }

    public function index() {

        try {
            $search = request('search') ?? '';
            $events = $this->eventRepository->search($search);

            return view('welcome',compact('events', 'search'));

        } catch (Exception $e) {
            echo $e->getMessage();
        }


    }

    public function create() {

        try {
            return view('events.create');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function store(Request $request) {

        try {
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

            $this->eventRepository->store($formInput);

            return redirect('/')->with('success', 'Event created successfully');

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function show(Event $event) {
        try {
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

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function edit(Event $event) {
        try {
            return view('events.edit', compact('event'));

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update(Event $event, Request $request) {
        try {
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
            $this->eventRepository->update($formInput, $event->id);

            return redirect('/')->with('success', 'Event updated successfully');

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function destroy(Event $event) {
        try {
            $this->eventRepository->destroy($event->id);

            return redirect('/')->with('success', 'Event deleted successfully');

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function dashboard() {
        try {
            $user = auth()->user();
            $events = $user->events;
            $eventsAsParticipant = $user->eventsAsParticipant;

            return view('events.dashboard', compact('events', 'eventsAsParticipant'));

        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    public function joinEvent(int $id) {
        try {
            $user = auth()->user();
            $user->eventsAsParticipant()->attach($id);
            $event = $this->eventRepository->getById($id);

            return redirect('/dashboard')->with('success', 'Sua presença está confirmada no evento ' . $event->title);

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function leaveEvent(int $id) {
        try {
            $user = auth()->user();
            $user->eventsAsParticipant()->detach($id);
            $event = $this->eventRepository->getById($id);

            return redirect('/dashboard')->with('success', 'Você saiu com sucesso do evento: ' . $event->title);

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
