<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::all();
        return response()->json([
            'success' => true,
            'data' => $reviews
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
            'property_id' => 'required|exists:properties,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ];
        $request->validate(rules: $rules);

            
        $review = Review::create([
            'traveler_id' => $request->traveler_id,
            'room_id' => $request->room_id,
            'property_id' => $request->property_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        

        return response()->json([
            'success' => true,
            'data' => $review
        ] , 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $review = Review::find($id);
        if (!$review) {
            return response()->json([
                'success' => false,
                'message' => 'Review not found'
            ] , 404);
        }
        return response()->json([
            'success' => true,
            'data' => $review
        ] , 200);
    }

   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
