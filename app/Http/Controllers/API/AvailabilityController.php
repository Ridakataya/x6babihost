<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Availability;

class AvailabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $availabilities = Availability::all();
        return response()->json([
            'success' => true,
            'data' => $availabilities
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
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_available' => 'required|boolean',
        ];
        $request->validate(rules: $rules);

            
        $availability = Availability::create([
            'room_id' => $request->room_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_available' => $request->is_available,
        ]);
        

        return response()->json([
            'success' => true,
            'data' => $availability
        ] , 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $availability = Availability::find($id);
        if (!$availability) {
            return response()->json([
                'success' => false,
                'message' => 'Availability not found'
            ] , 404);
        }
        return response()->json([
            'success' => true,
            'data' => $availability
        ] , 200);
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate rules
        $rules = [
            'room_id' => 'sometimes|required|exists:rooms,id',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'sometimes|required|date|after_or_equal:start_date',
            'is_available' => 'sometimes|required|boolean',
        ];

        $request->validate(rules: $rules);

        $availability = Availability::find($id);
        if (!$availability) {
            return response()->json([
                'success' => false,
                'message' => 'Availability not found'
            ] , 404);
        }

        $availability->update($request->only([
            'room_id', 
            'start_date', 
            'end_date', 
            'is_available'
        ]));

        return response()->json([
            'success' => true,
            'data' => $availability
        ] , 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $availability = Availability::find($id);
        if (!$availability) {
            return response()->json([
                'success' => false,
                'message' => 'Availability not found'
            ] , 404);
        }
        $availability->delete();
        return response()->json([
            'success' => true,
            'message' => 'Availability deleted successfully'
        ] , 200);
    }
}
