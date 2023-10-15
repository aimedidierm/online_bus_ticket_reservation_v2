<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\BusLocation;
use App\Models\Payment;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Paypack\Paypack;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips = Trip::latest()->get();
        $trips->load("bus");
        $buses = Bus::get();
        return view("admin.trips", ["trips" => $trips, "buses" => $buses]);
    }

    public function comming()
    {
        $trips = Payment::where('user_id', Auth::id())->where('status', 'Payed')->get();
        $trips->load('trip');
        return view('passenger.comming_trips', ['trips' => $trips]);
    }

    public function expired()
    {
        $trips = Payment::where('user_id', Auth::id())->where('status', 'Used')->get();
        $trips->load('trip');
        return view('passenger.expired_trips', ['trips' => $trips]);
    }

    public function track()
    {
        $location = BusLocation::latest()->first();
        return redirect("http://maps.google.com/maps?&z=15&mrt=yp&t=k&q=$location->location");
    }

    public function book(Request $request)
    {
        $request->validate(
            [
                "trip" => "required|integer",
                "phone" => "required|numeric|regex:/^07\d{8}$/",
            ],
            [
                'phone.regex' => 'The phone number must start with "07" and be 10 digits long.',
            ]
        );

        $trip = Trip::find($request->trip);
        if ($trip) {
            $trip->available_places = $trip->available_places - 1;
            $trip->update();
            $payment = new Payment;
            $payment->trip_id = $request->trip;
            $payment->amount = $trip->price;
            $payment->status = 'Payed';
            $payment->user_id = Auth::id();
            $payment->created_at = now();
            $payment->updated_at = null;
            $payment->save();
            $paypackInstance = $this->paypackConfig()->Cashin([
                "amount" => $trip->price,
                "phone" => $request->phone,
            ]);
            return redirect('/passenger/payments');
        } else {
            return redirect()->back()->withErrors('Trip not found');
        }
    }

    public function paypackConfig()
    {
        $paypack = new Paypack();

        $paypack->config([
            'client_id' => env('PAYPACK_CLIENT_ID'),
            'client_secret' => env('PAYPACK_CLIENT_SECRET'),
        ]);

        return $paypack;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "origin" => "required|string",
            "destination" => "required|string",
            "datetime" => "required|date",
            "price" => "required|numeric",
            "bus" => "required|integer",
        ]);

        $bus = Bus::find($request->bus);

        if ($bus) {
            $trip = new Trip;
            $trip->name = $request->name;
            $trip->origin = $request->origin;
            $trip->destination = $request->destination;
            $trip->time = $request->datetime;
            $trip->price = $request->price;
            $trip->available_places = $bus->capacity;
            $trip->bus_id = $request->bus;
            $trip->created_at = now();
            $trip->updated_at = null;
            $trip->save();
            return redirect("/admin/trips");
        } else {
            return redirect()->back()->withErrors("Bus not found");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        if ($trip) {
            $trip->delete();
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors("Trip not found");
        }
    }
}
