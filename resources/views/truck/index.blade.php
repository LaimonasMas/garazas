@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Truck list</div>
                <div class="card-body">

                    @foreach ($trucks as $truck)
                    <li class="list-group-item list-line">
                        <div>
                            <h5>Maker: {{$truck->maker}}</h5>
                            <h6>Plate: {{$truck->plate}}</h6>
                            <p>Mechanic notices: {{$truck->mechanic_notices}}</p>
                            Mechanic: {{$truck->truckMechanic->name}} {{$truck->truckMechanic->surname}}
                        </div>
                        <div class="list-line__buttons">
                            <div class="form-group">
                                <a class="btn btn-outline-secondary btn-sm" href="{{route('truck.edit',[$truck])}}">EDIT</a>
                            </div>
                            <form method="POST" action="{{route('truck.destroy', [$truck])}}">
                                @csrf
                                <button class="btn btn-outline-danger btn-sm" type="submit">DELETE</button>
                            </form>
                        </div>
                    </li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
