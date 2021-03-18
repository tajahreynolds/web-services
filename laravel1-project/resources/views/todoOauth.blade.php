<x-main-layout>
<x-slot name="pageTitle">
  Your Projects
</x-slot>
<x-slot name="SCRIPT">todoOauth.js</x-slot>
<div>
	@foreach ($projects as $project)
	<div>{{$project->name}}</div>
	@endforeach
</div>
<div id="msg"></div>
<ul id="tasks"></ul>
</x-main-layout>
