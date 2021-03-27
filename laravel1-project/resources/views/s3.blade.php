<x-main-layout>
<x-slot name="pageTitle">
  AWS S3 SDK
</x-slot>
<x-slot name="SCRIPT">s3.js</x-slot>
<form action="{{ url('api/s3') }}" method="PUT">
@csrf
<div class="form-group">
<label for="content">Content:</label>
<input class="form-control" type="text" id="capacity" name="content"><br>
<input type="submit" class="btn btn-primary">
</form>
</x-main-layout>
