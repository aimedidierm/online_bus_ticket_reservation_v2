<?php

namespace App\Http\Controllers;

use App\Models\BusLocation;
use App\Models\Hardware;
use Illuminate\Http\Request;

class HardwareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $request->validate([
            "card" => "sometimes|string",
            "location" => "sometimes|string"
        ]);

        if ($request->has('location')) {
            $location = new BusLocation;
            $location->location = $request->location;
            $location->save();
        }

        if ($request->has('card')) {
            if ($request->card == "ABC") {
                return response()->json([
                    'card_allowed' => true,
                    'ticket_used' => false,
                ], 200);
            } else {
                return response()->json([
                    'card_allowed' => false,
                    'ticket_used' => false,
                ], 200);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hardware $hardware)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hardware $hardware)
    {
        //
    }
}
