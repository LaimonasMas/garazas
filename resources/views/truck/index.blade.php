@foreach ($trucks as $truck)
  <a href="{{route('truck.edit',[$truck])}}">{{$truck->maker}} {{$truck->truckMechanic->name}} {{$truck->truckMechanic->surname}}</a>
  <form method="POST" action="{{route('truck.destroy', [$truck])}}">
   @csrf
   <button type="submit">DELETE</button>
  </form>
  <br>
@endforeach


