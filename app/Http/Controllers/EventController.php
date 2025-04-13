<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Event;

class EventController extends Controller
{
    public function createForm()
    {
        return view('admin.eventForm', ['event' => null]);
    }

    public function editForm(Event $event)
    {
        return view('admin.eventForm', ['event' => $event]);
    }

    public function createEvent(Request $request)
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

    public function editEvent(Request $request, Event $event)
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

        return redirect()->route('home')->with('status', 'Event edited successfully.');
    }
}
