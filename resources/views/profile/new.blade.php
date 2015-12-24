@extends('layouts.layout')
@section('home')
    <form method="POST" action="{{ url('profile/complete') }}">
        {!! csrf_field() !!}

        <div>
            Name
            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
        </div>

        <div>
            Phone
            <input class="form-control" type="text" name="phone" value="{{ old('phone') }}">
        </div>

        <div>
            Country
            <input class="form-control" type="text" name="country" value="{{ old('country') }}">
        </div>

        <div>
            City
            <input class="form-control" type="text" name="city" value="{{ old('city') }}">
        </div>

        <div>
            DOB
            <input class="form-control" type="date" name="dob">
        </div>


        <div>
            <button class="btn btn-success" type="submit">Save</button>
        </div>
    </form>
@stop