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
        <div class="col-sm-6 offset-2">
            <canvas id="myChart">

            </canvas>
        </div>

    </div>

    <rates :prices="{{json_encode($ratesData['prices'])}}"
           :dates="{{json_encode($ratesData['dates'])}}"
    ></rates>
@endsection
