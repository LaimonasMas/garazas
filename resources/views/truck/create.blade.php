@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Truck</div>

                <div class="card-body">
                    <form method="POST" action="{{route('truck.store')}}">
                        <div class="form-group">
                            <label>Maker: </label>
                            <input type="text" class="form-control" name="truck_maker">
                            <small class="form-text text-muted">Please enter Maker here</small>
                        </div>
                        <div class="form-group">
                            <label>Plate: </label>
                            <input type="text" class="form-control" name="truck_plate">
                            <small class="form-text text-muted">Please enter Plate here</small>
                        </div>
                        <div class="form-group">
                            <label>Make year: </label>
                            <input type="text" class="form-control" name="make_year">
                            <small class="form-text text-muted">Please enter Make Year here</small>
                        </div>
                        <div class="form-group">
                            <label>Mechanic notices: </label>
                            <textarea class="form-control" name="mechanic_notices"></textarea>
                            <small class="form-text text-muted">Please enter notes here</small>
                        </div>
                        <div class="form-group">
                            <select name="mechanic_id">
                                @foreach ($mechanics as $mechanic)
                                <option class="form-control" value="{{$mechanic->id}}">{{$mechanic->name}} {{$mechanic->surname}}</option>
                                @endforeach
                            </select>
                        </div>
                        @csrf
                        <button class="btn btn-outline-success btn-sm" type="submit">ADD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
