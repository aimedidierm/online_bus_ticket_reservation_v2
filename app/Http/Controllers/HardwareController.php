<?php

namespace App\Http\Controllers;

use App\Models\BusLocation;
use App\Models\Hardware;
use App\Models\Payment;
use App\Models\User;
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
            $user = User::where('card', $request->card)->first();
            if ($user) {
                $payment = Payment::where('user_id', $user->id)->get();
                if ($payment) {
                    $payedPayment = $payment->where('status', 'Payed');
                    if ($payedPayment->isNotEmpty()) {
                        $onePayment = $payedPayment->first();
                        $updatePayment = Payment::find($onePayment->id);
                        $updatePayment->status = 'Used';
                        $updatePayment->update();
                        return response()->json([
                            'card_allowed' => true,
                            'message' => 'Ticket Found',
                        ], 200);
                    }
                    $usedPayment = $payment->where('status', 'Used');
                    if ($usedPayment->isNotEmpty()) {
                        $onePayment = $usedPayment->first();
                        $updatePayment = Payment::find($onePayment->id);
                        $updatePayment->status = 'Used';
                        $updatePayment->update();
                        return response()->json([
                            'card_allowed' => true,
                            'message' => 'Ticket Used',
                        ], 200);
                    } else {
                        return response()->json([
                            'card_allowed' => false,
                            'message' => 'Ticket Unpaid',
                        ], 200);
                    }
                } else {
                    return response()->json([
                        'card_allowed' => false,
                        'message' => 'No ticket available',
                    ], 200);
                }
            } else {
                return response()->json([
                    'card_allowed' => false,
                    'message' => 'Card not found',
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
