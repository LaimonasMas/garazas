<form method="POST" action="{{route('truck.store')}}">
   Maker: <input type="text" name="truck_maker">
   Plate: <input type="text" name="truck_plate">
   Make year: <input type="text" name="make_year">
   Mechanic notices: <textarea name="mechanic_notices"></textarea>
   <select name="mechanic_id">
       @foreach ($mechanics as $mechanic)
           <option value="{{$mechanic->id}}">{{$mechanic->name}} {{$mechanic->surname}}</option>
       @endforeach
</select>
   @csrf
   <button type="submit">ADD</button>
</form>