@extends('layouts.app')

@section('content')
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="h2">Bitcoin chart</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 offset-4">
            <h3>Not enough data.<a href="{{ url('/fake/20') }}" target="_blank" class="text-sm text-gray-700 dark:text-gray-500 underline">Wanna run faker first?</a></h3>
        </div>
    </div>
@endsection
