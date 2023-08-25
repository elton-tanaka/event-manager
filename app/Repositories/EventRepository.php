<?php

namespace App\Repositories;

use App\Repositories\Interfaces\EventRepositoryInterface;
use App\Models\Event;

class EventRepository implements EventRepositoryInterface
{
    public function allEvents() {
        return Event::all();
    }

    public function storeEvent($data) {
        return Event::create($data);
    }

    public function findEvent(int $id) {
        return Event::find($id);
    }

    public function updateEvent($data, int $id) {
        $event = Event::where('id', $id)->first();
        $event->update($data);
        $event->save();
    }

    public function destroyEvent(int $id) {
        $event = Event::find($id);
        $event->delete();
    }
}
