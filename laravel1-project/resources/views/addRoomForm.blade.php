<x-main-layout>
<x-slot name="pageTitle">Add A Room</x-slot>

@if ($errors->any())
<div cless="alert alert-danger">
<strong>Oops!</strong> Your input was not accepted.<br><br>
<ul>
@foreach ($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul>
</div>
@endif

<form action="{{ url('room/add') }}" method="POST">
@csrf
<div class="form-group">
<label for="name">Room Name:</label>
<input class="form-control" id="name" type="text" name="roomName"><br>
</div>
<div class="form-group">
<label for="capacity">Capacity:</label>
<input class="form-control" id="capacity" type="number" name="capacity"><br>
</div>
<div class="form-group">
<label for="dept">Department:</label>
<input class="form-control" id="dept" type="text" name="dept"><br>
</div>
<div class="form-group">
<label for="desc">Description:</label>
<input class="form-control" id="desc" type="text" name="description"><br>
</div>
<div class="form-group">
<input type="submit" class="btn btn-primary">
</div>
</form>
</x-main-layout>
