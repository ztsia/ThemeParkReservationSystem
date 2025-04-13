<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;

class ItemController extends Controller
{
    public function createForm()
    {
        return view('admin.itemForm', ['item' => null]);
    }

    public function editForm(Item $item)
    {
        return view('admin.itemForm', ['item' => $item]);
    }

    public function createItem(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'normalPrice' => 'required|numeric|min:0|max:9999.99|regex:/^\d+(\.\d{1,2})?$/',
            'childrenSeniorPrice' => 'required|numeric|min:0|max:9999.99|regex:/^\d+(\.\d{1,2})?$/',
            'studentPrice' => 'required|numeric|min:0|max:9999.99|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/items', 'public');
            $data['image'] = $imagePath; 
        }
        else {
            $data['image'] = 'images/default.jpg'; // Set default image
        }

        Item::create($data);

        return redirect()->route('home')->with('status', 'Item created successfully.');
    }

    public function editItem(Request $request, Item $item)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'normalPrice' => 'required|numeric|min:0|max:9999.99|regex:/^\d+(\.\d{1,2})?$/',
            'childrenSeniorPrice' => 'required|numeric|min:0|max:9999.99|regex:/^\d+(\.\d{1,2})?$/',
            'studentPrice' => 'required|numeric|min:0|max:9999.99|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            // Store the new image
            $imagePath = $request->file('image')->store('images/items', 'public');
            $data['image'] = $imagePath; 
        }

        $item->update($data);

        return redirect()->route('home')->with('status', 'Item edited successfully.');
    }
}
