<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::all();
        return response()->json([
            'success' => true,
            'data' => $bookings
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
            'traveler_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'total_price' => 'required|numeric',
            'status' => 'required|string|max:50',
        ];
        $request->validate(rules: $rules);

        $booking = Booking::create([
            'traveler_id' => $request->traveler_id,
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'total_price' => $request->total_price,
            'status' => $request->status,
        ]);
        return response()->json([
            'success' => true,
            'data' => $booking
        ] , 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $booking
        ], 200);
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate rules
        $rules = [
            'traveler_id' => 'sometimes|exists:users,id',
            'room_id' => 'sometimes|exists:rooms,id',
            'check_in' => 'sometimes|date',
            'check_out' => 'sometimes|date|after:check_in',
            'total_price' => 'sometimes|numeric',
            'status' => 'sometimes|string|max:50',
        ];
        $request->validate(rules: $rules);

        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found'
            ], 404);
        }

        $booking->update($request->only([
            'traveler_id',
            'room_id',
            'check_in',
            'check_out',
            'total_price',
            'status',
        ]));

        return response()->json([
            'success' => true,
            'data' => $booking
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found'
            ], 404);
        }
        $booking->delete();
        return response()->json([
            'success' => true,
            'message' => 'Booking deleted successfully'
        ], 200);
    }
}
