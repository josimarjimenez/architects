<div class="main-content">
	<div class="project-body-header">
		<h1 id="tour-project-name">
			{{ $project->name }}
		</h1> 
		<div class="project-body-header-stats">
			<div class="stats-bubble">
				Total de iteraciones
				<h4>{{ $iterations }}</h4>
			</div>
			<div class="stats-bubble">
				Total historias
				<h4>{{ $totalStories }}</h4>
			</div>
			<div class="stats-bubble">
				Historias completadas
				<h4>{{ $completed }}</h4>
			</div>
			<div class="stats-bubble">
				Historias en progreso
				<h4>{{ $doing }}</h4>
			</div>
		</div>
	</div>
	<br><br>

	@if($iterations < 1)
		<h2>Crea un grupo de trabajo par empezar!</h2>
		{{ HTML::link('/projects/members/'.$project->id, 'Grupo de trabajo', array('class' => 'button green large', 'id' =>'newGroup'))}}
		{{ Form::open(array('url' => 'iterations/create', 'method'=>'GET','class' => 'pull-center')) }}
		{{ Form::hidden('projectid', $project->id) }}
		<h2>Aún no has creado iteraciones para crear tu primer iteración ;)</h2>
		{{ Form::submit('Nueva iteración', array('class' => 'button green large')) }}
		{{ Form::close() }}
	@else 
<!--
	<div style="margin-left:auto; margin-right:auto" class="story_form" id="story_form">
		@if(Auth::user()->rol=='Administrator')
		<ul id="createdStories"></ul>
		<div class="hidden" id="addStoryFormOnProgress">Guardando historia. Por favor espere...</div>
			
			<form id="addStoryForm" method="POST">
				<textarea maxlength="5000" name="summary" cols="50" rows="1" id="id_summary" style="height: 50px;"></textarea>    
				<button class="btn" type="submit" id="add_button">Agregar historia</button>
			</form>
		@endif
		</div>-->
		
	<div style="text-align:center; margin-top:20px;" id="burnup_chart">
			<!--<img src="{{ action('GraphicsTestController@summary', array('project' =>  $project->id)) }}">-->

			<img src="{{ action('GraphicsIterationController@bar_time', array('project' =>  $project->id)) }}">

			<img src="{{ action('GraphicsIterationController@line_time', array('project' =>  $project->id)) }}">

			<img src="{{ action('GraphicsIterationController@bar_budget', array('project' =>  $project->id)) }}">
			
			<img src="{{ action('GraphicsIterationController@line_budget', array('project' =>  $project->id)) }}">

	</div>	
	@endif 
</div>

<script type="text/javascript">
$( document ).ready(function() 
{ 
	var pathname = window.location.pathname.split("/");
	var id = pathname[pathname.length-1];
	var rol = "{{  Auth::user()->rol; }}" ;
	createProjMenu(id, rol); 
});
</script>