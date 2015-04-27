{{ HTML::link('#', 'Proyectos', array('class'=>'','id'=>'proyectosResp')) }}
<ul class="proyectoSub">  
	@foreach ($organization->projects as $project)
	<li class="">
		<a id="proyectID" class="organization-project-link" href="/projects/{{ $project->id }}" >
			{{ $project->name }}
		</a>
	</li>
	@endforeach 
</ul>