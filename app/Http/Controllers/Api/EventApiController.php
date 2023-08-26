<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\EventRepositoryInterface;
use App\Models\Event;
use Illuminate\Support\Facades\Response;
use Throwable;


class EventApiController extends BaseApiController
{
    private $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository) {
        $this->eventRepository = $eventRepository;
    }

    public function getAllEvents() {
        try {
            return $this->sendResponse($this->eventRepository->getAll(), 'Events Retrieved Successfully.');

        } catch (Throwable $exception) {
            return $this->sendError('A Error has occured', $exception, '500');
        }
    }

    public function getEventById(int $id) {
        try {
            $event = $this->eventRepository->getById($id);

            if(isset($event)) {
                return $this->sendResponse($this->eventRepository->getById($id), 'Event Retrieved Successfully.');
            }
            return $this->sendError('Event not found');

        } catch (Throwable $exception) {
            return $this->sendError('A Error has occured', $exception, '500');
        }
    }
}
