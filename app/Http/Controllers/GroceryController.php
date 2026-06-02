<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GroceryItem;

class GroceryController extends Controller
{
    /* Show all grocery items */
    public function index()
    {
        $items = GroceryItem::latest()->get();
        return view('grocery.index', compact('items'));
    }

    /* Store a new grocery item */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
            'unit'     => 'nullable|string|max:50',
            'notes'    => 'nullable|string|max:500',
        ]);

        GroceryItem::create([
            'user_id'  => Auth::id(),
            'name'     => $request->name,
            'category' => $request->category,
            'quantity' => $request->quantity,
            'unit'     => $request->unit,
            'status'   => 'pending',
            'notes'    => $request->notes,
        ]);

        return redirect()->route('grocery.index')->with('success', 'Item added to your grocery list!');
    }

    /* Update a grocery item */
    public function update(Request $request, GroceryItem $grocery)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
            'unit'     => 'nullable|string|max:50',
            'status'   => 'required|in:pending,completed',
            'notes'    => 'nullable|string|max:500',
        ]);

        $grocery->update([
            'name'     => $request->name,
            'category' => $request->category,
            'quantity' => $request->quantity,
            'unit'     => $request->unit,
            'status'   => $request->status,
            'notes'    => $request->notes,
        ]);

        return redirect()->route('grocery.index')->with('success', 'Item updated successfully!');
    }

    /* Delete a grocery item */
    public function destroy(GroceryItem $grocery)
    {
        $grocery->delete();
        return redirect()->route('grocery.index')->with('success', 'Item removed from your list!');
    }
}