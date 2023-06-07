@extends('layouts.app')

@section('content')
    <div class="container">
        <dashboard :users="{{$users}}"></dashboard>
    </div>
@endsection
