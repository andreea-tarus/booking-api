@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center mt-3">
            <div class="col-md-9">
                <h2 style="color: #fff;">Your Bookings</h2>
                @foreach($bookings as $index => $booking)
                    <div class="card mb-3">
                        <div class="card-body p-0 position-relative">
                            <div class="col-md-6 col-12 p-0">
                                <img class="hotel-image" src="{{asset($trips[$index]->image)}}">
                            </div>
                            <div class="col-md-6 col-12 p-md-5 p-3 hotel-info">
                                <div>
                                    <h3 class="title">{!! __($trips[$index]->getTitle()) !!}</h3>
                                    <p class="description">{!! __($trips[$index]->getDescription()) !!}</p>
                                    <p>{{ __("Arrival: " . $booking->getArrivalDate() )}}</p>
                                    <p>{{ __("Staying: " . $booking->getNights() . "night(s)") }}</p>
                                </div> 
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
