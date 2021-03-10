<x-main-layout>
<x-slot name="pageTitle">
  Room List
</x-slot>
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
<table class='table'>
<tr><td>Building Name</td><td>Room Number</td><td>Capacity</td>
<td>Department</td><td>Description</td><td>Image</td>
</tr>
@foreach ($roomCollection as $room)
<tr>
<td>{{$room->buildingName}}</td>
<td>{{$room->roomNum}}</td>
<td>{{$room->capacity}}</td>
<td>{{$room->dept}}</td>
<td>{{$room->description}}</td>
@if (strcmp($room->image,'') == 0)
<td>&nbsp;</td>
@else
<td><a href={{$room->image}}>Image</a></td>
@endif
</tr>
@endforeach
</table>
</x-main-layout>
