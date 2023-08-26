<?php

namespace App\Repositories;

use App\Repositories\Interfaces\EventRepositoryInterface;
use App\Models\Event;

class EventRepository implements EventRepositoryInterface
{
    public function getAll() {
        return Event::all();
    }

    public function store($data) {
        return Event::create($data);
    }

    public function getById(int $id) {
        return Event::find($id);
    }

    public function update($data, int $id) {
        $event = Event::where('id', $id)->first();
        $event->update($data);
        $event->save();
    }

    public function destroy(int $id) {
        $event = Event::find($id);
        $event->delete();
    }

    public function search(String $input = '') {
        return Event::where(function ($query) use ($input) {
            $query->where('title', 'like', '%'.$input.'%');
            })->orderByDesc('promoted')->get();
    }
}
