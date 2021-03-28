@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Mechanic</div>

                <div class="card-body">
                    <form method="POST" action="{{route('mechanic.store')}}">
                        <div class="form-group">
                            <label>Name: </label>
                            <input type="text" class="form-control" name="mechanic_name">
                            <small class="form-text text-muted">You can enter Name here</small>
                        </div>
                        <div class="form-group">
                            <label>Surname: </label>
                            <input type="text" class="form-control" name="mechanic_surname">
                            <small class="form-text text-muted">You can enter Surname here</small>
                        </div>
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary btn-sm">ADD</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
