<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class EventController extends Controller
{
    public function store(StoreEventRequest $request)
    {

        $event = Event::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'country' => $request->country,
            'capacity' => $request->capacity,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);
        return new EventResource($event);
    }

    /**
     * Display a listing of events with pagination and filters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        // Validate query parameters
        $validator = Validator::make($request->all(), [
            'country' => 'sometimes|string|max:255',
            'title' => 'sometimes|string|max:255',
            'start_after' => 'sometimes|date',
            'end_before' => 'sometimes|date',
            'per_page' => 'sometimes|integer|min:1|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Start building query
        $query = Event::query();

        // Apply filters
        if ($request->filled('country')) {
            $query->where('country', 'like', '%' . $request->country . '%');
        }

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('start_after')) {
            $query->where('start_time', '>=', $request->start_after);
        }

        if ($request->filled('end_before')) {
            $query->where('end_time', '<=', $request->end_before);
        }

        // Paginate results
        $perPage = $request->get('per_page', 15); // Default 15 per page
        $events = $query->paginate($perPage);

        // Return paginated resource collection
        return EventResource::collection($events);
    }

    public function show(Event $event)
    {
        return new EventResource($event);
    }

    public function update(StoreEventRequest $request, Event $event)
    {
        $event->update($request->validated());
        return new EventResource($event);
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['message' => 'Event deleted']);
    }
}