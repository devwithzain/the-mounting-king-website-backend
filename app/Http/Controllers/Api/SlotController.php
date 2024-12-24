<?php

namespace App\Http\Controllers\Api;

use App\Models\Slot;
use App\Http\Requests\SlotRequest;
use App\Http\Controllers\Controller;

class SlotController extends Controller
{
    public function index()
    {
        $slots = Slot::all();
        return response()->json($slots);
    }
    public function store(SlotRequest $request)
    {
        $validatedData = $request->validated();
        $slot = Slot::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'days' => json_encode($validatedData['days']),
            'timings' => json_encode($validatedData['timings']),
            'is_active' => $validatedData['is_active'],
        ]);
        return response()->json(['success' => 'Slot added successfully.', 'data' => $slot], 201);
    }
    public function update(SlotRequest $request, $id)
    {
        $slot = Slot::findOrFail($id);
        $slot->update($request->all());
        return response()->json(['success' => 'Slot updated successfully!']);
    }
    public function destroy($id)
    {
        $slot = Slot::findOrFail($id);
        $slot->delete();
        return response()->json(['success' => 'Slot deleted successfully!']);
    }
}