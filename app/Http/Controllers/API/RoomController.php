<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms= Room::all();
        return response()->json([
            'success' => true,
            'data' => $rooms
        ] , 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate rules
        $rules = [
            'property_id' => 'required|exists:properties,id',
            'room_type' => 'required|string|max:255',
            'description' => 'required|string',
            'capacity' => 'required|integer',
            'price' => 'required|numeric',
        ];
        $request->validate(rules: $rules);

            
        $room = Room::create([
            'property_id' => $request->property_id,
            'room_type' => $request->room_type,
            'description' => $request->description,
            'capacity' => $request->capacity,
            'price' => $request->price,
        ]);
        

        return response()->json([
            'success' => true,
            'data' => $room
        ] , 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $room = Room::find($id);
        if (!$room) {
            return response()->json([
                'success' => false,
                'message' => 'Room not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $room
        ], 200);
    }

  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate rules
        $rules = [
            'property_id' => 'sometimes|required|exists:properties,id',
            'room_type' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'capacity' => 'sometimes|required|integer',
            'price' => 'sometimes|required|numeric',
        ];
        $request->validate(rules: $rules);

        $room = Room::find($id);
        if (!$room) {
            return response()->json([
                'success' => false,
                'message' => 'Room not found'
            ], 404);
        }
        $room->update($request->only([
            'property_id',
            'room_type',
            'description',
            'capacity',
            'price'
        ]));
        return response()->json([
            'success' => true,
            'data' => $room
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = Room::find($id);
        if (!$room) {
            return response()->json([
                'success' => false,
                'message' => 'Room not found'
            ], 404);
        }
        $room->delete();
        return response()->json([
            'success' => true,
            'message' => 'Room deleted successfully'
        ], 200);
    }
}
