@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Truck</div>

                <div class="card-body">
                    <form method="POST" action="{{route('truck.update',[$truck])}}">
                        <div class="form-group">
                            <label>Maker: </label>
                            <input type="text" class="form-control" name="truck_maker" value="{{$truck->maker}}">
                            <small class="form-text text-muted">You can edit Maker here</small>
                        </div>
                        <div class="form-group">
                            <label>Plate: </label>
                            <input type="text" class="form-control" name="truck_plate" value="{{$truck->plate}}">
                            <small class="form-text text-muted">You can edit Plate here</small>
                        </div>

                        <div class="form-group">
                            <label>Make year: </label>
                            <input type="text" class="form-control" name="make_year" value="{{$truck->make_year}}">
                            <small class="form-text text-muted">You can edit Make Year here</small>
                        </div>
                        <div class="form-group">
                            <label>Mechanic notices: </label>
                            <textarea class="form-control" name="mechanic_notices">{{$truck->mechanic_notices}}</textarea>
                            <small class="form-text text-muted">You can edit notes here</small>
                        </div>
                        <div class="form-group">
                            <select name="mechanic_id">
                                @foreach ($mechanics as $mechanic)
                                <option class="form-control" value="{{$mechanic->id}}" @if($mechanic->id == $truck->mechanic_id) selected @endif>{{$mechanic->name}} {{$mechanic->surname}}</option>
                                @endforeach
                            </select>
                        </div>
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary btn-sm">EDIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
