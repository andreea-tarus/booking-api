@extends('layouts.app')
<?php
    $url = request()->url();
    $parts = explode('/', $url);
    $date = $parts[5];
    $nights = $parts[7];
?>
@section('content')
    <form method="POST" action="{{ route('trips.index', ['date' => $date, 'nights' => $nights]) }}">
        @csrf
        <input type="hidden" name="date" value="{{ $date }}">
        <input type="hidden" name="nights" value="{{ $nights }}">
        <div class="container text-left mt-5">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <a href="#" data-toggle="collapse" data-target="#filter-form" class="btn btn-secondary col-6">Filter</a>
                </div>
            </div>
        </div>  
        <div class="collapse" id="filter-form">
            <div class="container">    
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                @include('includes.filtering')
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
            <div class="container text-right">
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <button type="submit" class="btn btn-primary" style="width:50%;">APPLY FILTERS</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="container mt-5">
        <form method="POST" action="{{ route('trips.display-single-trip', ['date' => $date, 'nights' => $nights]) }}">
        @csrf  
            <input type="hidden" name="date" value="{{ $date }}">
            <input type="hidden" name="nights" value="{{ $nights }}">
            @foreach($trips as $trip)
                <div class="row justify-content-center mt-3">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body p-0 position-relative">
                                <div class="col-md-6 col-12 p-0">
                                    <img class="hotel-image" src="{{asset($trip->image)}}">
                                </div>
                                <div class="col-md-6 col-12 p-md-5 p-3 hotel-info">
                                    <div>
                                        <h3 class="title">{!! __($trip->getTitle()) !!}</h3>
                                        <p class="description">{!! __($trip->getDescription()) !!}</p>
                                    </div> 
                                    <div class="price-button">
                                        <button type="submit" name="slug" value="{{ $trip->getSlug() }}" class="btn btn-primary col-12 mb-md-5 mb-3 mr-md-5 mr-3">{!! $trip->getPrice() !!}RON</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </form>
    </div>
@endsection
