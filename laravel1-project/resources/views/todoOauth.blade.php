<x-main-layout>
<x-slot name="pageTitle">
  Your Projects
</x-slot>
<x-slot name="SCRIPT">todoOauth.js</x-slot>
<div class="content">
	<div id="projects" class="d-flex flex-wrap justify-content-center">
		@foreach ($projects as $project)
		<div style="margin:10px" class="click p-2 w-20 btn btn-secondary" href="{{$project['id']}}">{{$project['name']}}</div>
		@endforeach
	</div>		
</div>
<div id="tasks" class="text-center"></div>
<div id="msg"></div>
<br><br>
<a href="?cmd=logout">Logout</a>
<script>token="{{$token}}";</script>
</x-main-layout>
