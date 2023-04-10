@extends('layouts.app')
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-white-500 underline">Home</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-white-500 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-white-500 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif


</div>
@section('content')
<form method="POST" action="{{ route('trips.index') }}">
    @csrf   
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3 class="text-center">{{ __('You can try our Random Town Generator if you don\'t know what to visit yet.') }}</h3></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p class="text-center">{{ __('Click the button to generate a random town:')}}</p>
                        <div class="text-center">
                            <button id="generate-btn" class="btn btn-secondary">{!! __('Generate') !!}</button>
                        </div>
                        <h2 class="text-center" id="search"></h2>
                        <input type="hidden" name="search">                    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h4 class="text-center"><strong>{{ __('Please note that in order for you to complete a booking, you have to log in.') }}</strong></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container text-left mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="#" data-toggle="collapse" data-target="#filter-form" class="btn btn-secondary col-6">{!! __('Filter') !!}</a>
            </div>
        </div>
    </div>
    <div class="collapse" id="filter-form">
        <div class="container">    
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            @include('includes.filtering')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container text-right mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <input type="date" class="col-md-3 col-12 px-0 d-inline datepicker" required id="datepicker" name="date" placeholder="Select Date">
                <select name="nights" class="col-md-3 col-12 px-0 d-inline nights" required>
                    @for($i = 0; $i < 10; $i++)
                        <option value="{{ $i + 1 }}">{!! $i + 1 . __('night(s)') !!}</option>
                    @endfor
                </select>
                <button type="submit" class="btn btn-primary col-6 px-0">{!! __('NEXT') !!}</button>
            </div>
        </div>
    </div>
</form>
@push('scripts')
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(function() {
      $( "#datepicker" ).datepicker("dateFormat", 'd MM, y');
    });

    $(document).ready(function() {
        var location = {!! json_encode($locations->toArray()) !!};
        $('#generate-btn').click(function(event) {
            event.preventDefault();
            var randomTown = location[Math.floor(Math.random() * location.length)];
            $('#search').text(randomTown);
            $('input[name="search"]').val(randomTown);
        });
    });
</script>

@endpush
@endsection
