@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Truck: {{$truck->maker}}</h4>
                </div>

                <div class="card-body">
                    <h4>Maker: {{$truck->maker}}</h4>
                    <h5>Plate: {{$truck->plate}}</h5>
                    <h5>Make year: {{$truck->make_year}} </h5>
                    <h5>Mechanic notices: {{$truck->mechanic_notices}}</h5>
                    <div class="form-group">
                        <a class="btn btn-outline-success btn-sm" href="{{route('truck.index')}}">ALL TRUCKS</a>
                        <a class="btn btn-outline-secondary btn-sm" href="{{route('truck.edit',[$truck])}}">EDIT TRUCK</a>
                        <a class="btn btn-outline-secondary btn-sm" href="{{route('mechanic.edit',[$truck->truckMechanic])}}">EDIT MECHANIC</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
