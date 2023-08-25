<?php

namespace App\Repositories\Interfaces;
use App\Models\Event;

Interface EventRepositoryInterface
{
    public function allEvents();
    public function storeEvent(Event $data);
    public function findEvent(int $id);
    public function updateEvent(Event $data, int $id);
    public function destroyEvent(int $id);
}
