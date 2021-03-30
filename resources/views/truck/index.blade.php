@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                    <h2>Truck list</h2>
                    <div class="make-inline">
                        <form action="{{route('truck.index')}}" method="get" class="make-inline">
                            <div class="form-group make-inline">
                                <label>Mechanic: </label>
                                <select class="form-control" name="mechanic_id">
                                    <option value="0" @if($filterBy==0) selected @endif>All Mechanics</option>
                                    @foreach ($mechanics as $mechanic)
                                    <option value="{{$mechanic->id}}" @if($filterBy==$mechanic->id) selected @endif>
                                        {{$mechanic->name}} {{$mechanic->surname}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="form-check-label">Sort by Maker:</label>
                            <label class="form-check-label" for="sortASC">ASC</label>
                            <div class="form-group make-inline column">
                                <input type="radio" class="form-check-input" name="sort" value="asc" id="sortASC" @if($sortBy=='asc' ) checked @endif>
                            </div>
                            <label class="form-check-label" for="sortDESC">DESC</label>
                            <div class="form-group make-inline column">
                                <input type="radio" class="form-check-input" name="sort" value="desc" id="sortDESC" @if($sortBy=='desc' ) checked @endif>
                            </div>
                            <button type="submit" class="btn btn-outline-success btn-sm">Filter</button>
                        </form>

                        <a href="{{route('truck.index')}}" class="btn btn-outline-secondary btn-sm">Clear</a>
                    </div>

                </div>
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
                                <a href="{{route('truck.show',[$truck])}}" class="btn btn-outline-success btn-sm">SHOW</a>
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
