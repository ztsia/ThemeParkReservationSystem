<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;
use App\Models\Cart;

class ItemController extends Controller
{

    public function show($id)
    {
        $item = Item::find($id);  // Retrieve the item by ID
        if (!$item) {
            return redirect()->route('home')->with('status', 'Item not found.');
        }
        
        // Get date ranges
        $today = now()->startOfDay();
        $endOfDay = now()->endOfDay();
        $endOfWeek = now()->addDays(6)->endOfDay(); // 7 days including today
        
        // Today's statistics
        $todayPaidCart = Cart::where('item_id', $id)
                            ->whereNotNull('payment_date')
                            ->whereBetween('ticket_date', [$today, $endOfDay])
                            ->count();
                            
        $todayUnpaidCart = Cart::where('item_id', $id)
                              ->whereNull('payment_date')
                              ->whereBetween('ticket_date', [$today, $endOfDay])
                              ->count();
        
        // This week's statistics (including today)
        $weeklyPaidCart = Cart::where('item_id', $id)
                            ->whereNotNull('payment_date')
                            ->whereBetween('ticket_date', [$today, $endOfWeek])
                            ->count();
                            
        $weeklyUnpaidCart = Cart::where('item_id', $id)
                              ->whereNull('payment_date')
                              ->whereBetween('ticket_date', [$today, $endOfWeek])
                              ->count();
        
        // Overall future statistics
        $paidCart = Cart::where('item_id', $id)
                        ->whereNotNull('payment_date')
                        ->where('ticket_date', '>=', $today)
                        ->count();
                        
        $unpaidCart = Cart::where('item_id', $id)
                          ->whereNull('payment_date')
                          ->where('ticket_date', '>=', $today)
                          ->count();
        
        // Pass all variables to the view
        return view('itemDetails', compact(
            'item', 
            'paidCart', 
            'unpaidCart',
            'todayPaidCart',
            'todayUnpaidCart',
            'weeklyPaidCart',
            'weeklyUnpaidCart'
        ));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.itemForm', ['item' => null]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('admin.itemForm', ['item' => $item]);
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
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
            if ($item->image && $item->image != 'images/default.jpg') {
                Storage::disk('public')->delete($item->image);
            }
            // Store the new image
            $imagePath = $request->file('image')->store('images/items', 'public');
            $data['image'] = $imagePath; 
        }

        $item->update($data);

        return redirect()->route('home')->with('status', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        // Delete the image if it exists
        if ($item->image && $item->image != 'images/default.jpg') {
            Storage::disk('public')->delete($item->image);
        }
        $item->delete();

        return redirect()->route('home')->with('status', 'Item deleted successfully.');
    }
}
