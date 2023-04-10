@extends('layouts.app')

@section('content')
    <div class="container mt-5">
            <div class="row justify-content-center mt-3">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h4>{!! __('Your Booking') !!}</h4>
                        </div>
                        <div class="card-body p-0 position-relative">
                            <div class="col-md-6 col-12 p-0">
                                <img class="hotel-image" src="{{asset($tripInfo->image)}}">
                            </div>
                            <div class="col-md-6 col-12 p-md-5 p-3 hotel-info">
                                <div>
                                    <h3 class="title">{!! __($tripInfo->getTitle()) !!}</h3>
                                    <p class="description">{!! __($tripInfo->getDescription()) !!}</p>
                                    <p>{{ __("Arrival: " . $tripBooked->getArrivalDate() )}}</p>
                                    <p>{{ __("Staying: " . $tripBooked->getNights() . "night(s)") }}</p>
                                </div> 
                                <div class="price-button">
                                    <form method="POST" action="{{ route('trips.return-all-bookings')}}">
                                        @csrf
                                        <button  name="slug" class="btn btn-primary col-12 mb-md-5 mb-3 mr-md-5 mr-3">{{ __("Go To Your Bookings Page") }}</button>
                                    </form> 
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection
