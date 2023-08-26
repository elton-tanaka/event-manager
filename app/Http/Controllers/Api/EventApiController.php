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
            return response()->json([
                'message' => 'Events Retrieved Successfully.',
                'data' => $this->eventRepository->getAll()
            ]);
        } catch (Throwable $exception) {
            return response()->json([
                'message' => 'A Error has occured',
                'data' => $exception
                        ], 401);
        }
    }

    public function getEventById(int $id) {
        try {
            $event = $this->eventRepository->getById($id);

            if(isset($event)) {
                return response()->json([
                    'message' => 'Event Retrieved Successfully.',
                    'data' => $this->eventRepository->getById($id)
                ]);
            }

            return response()->json([
                'message' => 'Events not found'
            ], 404);

        } catch (Throwable $exception) {
            return response()->json([
                'message' => 'A Error has occured',
                'data' => $exception
                        ], 401);
        }
    }
}
