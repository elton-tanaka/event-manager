<?php

namespace App\Repositories\Interfaces;
use App\Models\Event;

Interface EventRepositoryInterface
{
    public function getAll();
    public function store(Event $data);
    public function getById(int $id);
    public function update(Event $data, int $id);
    public function destroy(int $id);
    public function search(String $input);
}
