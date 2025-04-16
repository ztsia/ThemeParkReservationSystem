<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.eventForm', ['event' => null]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('admin.eventForm', ['event' => $event]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date' => 'required|date',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/events', 'public');
            $data['image'] = $imagePath; 
        }
        else {
            $data['image'] = 'images/default.jpg'; // Set default image
        }

        Event::create($data);

        return redirect()->route('home')->with('status', 'Event created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date' => 'required|date',
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            // Store the new image
            $imagePath = $request->file('image')->store('images/events', 'public');
            $data['image'] = $imagePath; 
        }

        $event->update($data);

        return redirect()->route('home')->with('status', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        // Delete the image if it exists
        if ($event->image && $event->image != 'images/default.jpg') {
            Storage::disk('public')->delete($event->image);
        }
        $event->delete();

        return redirect()->route('home')->with('status', 'Event deleted successfully.');
    }
}
