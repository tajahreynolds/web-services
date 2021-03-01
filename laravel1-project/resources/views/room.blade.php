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
<tr><td>Name</td><td>Capacity</td>
<td>Department</td><td>Description</td>
</tr>
@foreach ($roomCollection as $room)
<tr><td>{{$room->roomName}}</td>
<td>{{$room->capacity}}</td>
<td>{{$room->dept}}</td>
<td>{{$room->description}}</td>
</tr>
@endforeach
</table>
</x-main-layout>
