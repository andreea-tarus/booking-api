<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Customer;
use Illuminate\Http\Request;

class TripController extends Controller
{

    public function main() 
    {
        $locations = Trip::distinct('location')->pluck('location');

        return view('welcome', ["locations" => $locations]);
    }
 
    public function index(Request $request)
    {
        $trips = Trip::query();

        // Filter by search query
        $searchQuery = $request->input('search');
        if(!is_null($searchQuery)){
            $trips->where(function ($query) use ($searchQuery) {
                $query->where('title', 'like', "%$searchQuery%")
                    ->orWhere('description', 'like', "%$searchQuery%")
                    ->orWhere('location', 'like', "%$searchQuery%");
            });
        }
      
        // Order by column and direction
        $order = explode('_', $request->input('orderBy'));
        $orderAscDesc = $order[1];
        $orderBy = $order[0];
        $trips->orderBy($orderBy, $orderAscDesc);

        // Filter by price range
        $fromPrice = $request->input('fromPrice');
        if (!is_null($fromPrice)) {
            $trips->where('price', '>=', $fromPrice);
        }

        $toPrice = $request->input('toPrice');
        if (!is_null($toPrice)) {
            $trips->where('price', '<=', $toPrice);
        }

        $trips = $trips->get();
        
        $request->session()->put('trips', $trips);

        return redirect()->route('trips.display-all',  [
            "date" => $request->input('date'),
            "nights" => $request->input('nights'),
            "trips" => $trips
        ]);
    }

    public function displayTrips($date, $nights) 
    {
        $trips = session('trips');

        return view('trips.index', [
            "date" => $date,
            "nights" => $nights,
            "trips" => $trips]);
    }


    public function displayTripToBook(Request $request) 
    {
        $slug = $request->input('slug');

        return view('trips.display-single-trip', [
            "date" => $request->input('date'),
            "nights" => $request->input('nights'),
            'tripToBook' => $this->getTripToBook($slug)
        ]);

    }

    public function getTripToBook($slug) 
    {
        try {
            $tripToBook = Trip::where('slug', $slug)->firstOrFail();
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            return redirect()->route('main-page');
        }

        return $tripToBook;
    }

    public function processBooking(Request $request) 
    {
        $userId = auth()->id();
        $slug = $request->input('slug');
        $date = $request->input('date');
        $nights = $request->input('nights');

        $customer = new Customer;
        $customer->setUserId($userId);
        $customer->setTripSlug($slug);
        $customer->setArrivalDate($date);
        $customer->setNights($nights);

        if($customer->save()) {
            return view('trips.confirmation', [
                'tripInfo' => $this->getTripToBook($slug),
                'tripBooked' => $customer
            ]);
        } else {
            return redirect()->route('main-page');
        }
    }

    public function displayAllBookings(Request $request)
    {
        $userId = auth()->id();
        $bookings = Customer::where('user_id', $userId)->orderBy('arrival_date', 'asc')->get();
        $trips = [];
        foreach($bookings as $index => $booking) {
            array_push($trips, $this->getTripToBook($booking->getTripSlug()));
        }

        return view('trips.display-all-bookings', ['bookings' => $bookings, 'trips' => $trips]);
    }

    public function store(Request $request)
    {
        $trip = Trip::create($request->all());

        return response()->json($trip, 201);
    }

    public function showBySlug($slug)
    {
        $trip = Trip::where('slug', $slug)->firstOrFail();

        return response()->json([
            'data' => $trip
        ]);
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $slug)
    {
        $trip = Trip::where('slug', $slug)->firstOrFail();
        $trip->update($request->all());

        return response()->json($trip);
    }

    public function destroy($slug)
    {
        $trip = Trip::where('slug', $slug)->firstOrFail();
        $trip->delete();

        return response()->json(null, 204);
    }
}
