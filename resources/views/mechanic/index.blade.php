@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Mechanic list</h2>
                    <a href="{{route('mechanic.index', ['sort' => 'surname'])}}">Sort by surname</a>
                    <a href="{{route('mechanic.index', ['sort' => 'name'])}}">Sort by name</a>
                    <a href="{{route('mechanic.index')}}">Default</a>
                </div>
                <div class="card-body">

                    @foreach ($mechanics as $mechanic)
                    <li class="list-group-item list-line">
                        <div>
                            {{$mechanic->name}} {{$mechanic->surname}}
                        </div>
                        <div class="list-line__buttons">
                            <div class="form-group">
                                <a class="btn btn-outline-secondary btn-sm" href="{{route('mechanic.edit',[$mechanic])}}">EDIT</a>
                            </div>
                            <form method="POST" action="{{route('mechanic.destroy', [$mechanic])}}">
                                @csrf
                                <button class="btn btn-outline-danger btn-sm" type="submit">DELETE</button>
                            </form>
                        </div>
                        @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
