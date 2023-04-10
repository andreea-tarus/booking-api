@extends('layouts.app')
<?php
    $url = request()->url();
    $parts = explode('/', $url);
    $date = $parts[6];
    $nights = $parts[8];
?>
@section('content')
    <div class="container mt-5">
        <form method="POST" action="{{ route('trips.process-booking', ['date' => $date, 'nights' => $nights]) }}">
        @csrf
            <input type="hidden" name="date" value="{{ $date }}">
            <input type="hidden" name="nights" value="{{ $nights }}">
            <div class="row justify-content-center mt-3">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body p-0 position-relative">
                            <div class="col-md-6 col-12 p-0">
                                <img class="hotel-image" src="{{asset($tripToBook->image)}}">
                            </div>
                            <div class="col-md-6 col-12 p-md-5 p-3 hotel-info">
                                <div>
                                    <h3 class="title">{!! __($tripToBook->getTitle()) !!}</h3>
                                    <p class="description">{!! __($tripToBook->getDescription()) !!}</p>
                                    <p class="description"><strog>{!! __('Price:') !!}</strog> {!! $tripToBook->getPrice() !!}RON</p>
                                </div> 
                                @guest
                                    <div class="price-button">
                                        <h4 class="mb-3">
                                            {!! __("Please login!") !!}
                                        </h4>
                                    </div>
                                @else
                                    <div class="price-button">
                                        <button type="submit" name="slug" value="{{ $tripToBook->getSlug() }}" class="btn btn-primary col-12 mb-md-5 mb-3 mr-md-5 mr-3">{!! __('Book now') !!}</button>
                                    </div>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection
