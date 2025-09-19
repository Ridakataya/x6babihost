<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Host;
use App\Models\User;

class HostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hosts= Host::all();
        return response()->json([
            'success' => true,
            'data' => $hosts
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
        $host = Host::create($request->all());
        return response()->json([
            'success' => true,
            'data' => $host
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $host = Host::find($id);
        if (!$host) {
            return response()->json([
                'success' => false,
                'message' => 'Host not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $host
        ], 200);
    }
    
    // Get all properties owned by a specific host
    public function properties($id)
    {
        $host = User::findOrFail($id);

        if ($host->role !== 'host') {
            return response()->json(['error' => 'User is not a host'], 400);
        }

        return response()->json($host->properties); // Assuming User has properties() relationship
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
