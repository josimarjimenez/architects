
@if(!empty($message))
<ul id="messages">
	<li id="message_1"><a onclick="$('#message_1').fadeOut(); return false;" href="#"><small>Limpiar</small></a>{{ $message }}</li>
</ul>
@endif
<div class="project-body-header">
	 	
	<h1 id="tour-iteration-name">
		{{ $iteration->name }} 
		<span class="iteration-title-date">
			{{ $iteration->start }} - {{ $iteration->end }}
		</span>
	</h1>
	<div id="iteration_stats" class="project-body-header-stats">
		<div class="stats-bubble">
			Historias
			<h4>{{ $countIssues }}</h4> 
		</div>
		<div class="stats-bubble">
			Total Puntos
			<h4>{{ $totalPoints }}</h4> 
		</div>
		<div class="stats-bubble">
			Puntos en progreso
			<h4>0</h4> 
		</div>
		<div class="stats-bubble">
			Puntos completados
			<h4>0</h4> 
		</div>	
		<div class="stats-bubble">
			Dias restantes
			<h4>3</h4> 
		</div>
	</div>
	<div style="text-align:center; margin-top:20px;" id="burnup_chart">
 		<img src="{{ action('GraphicsController@iterationSummary', array('iteration' =>  $iteration->id)) }}">
	</div>	
</div>


<div class="container wide_body" id="body">
	@if($hasmembers)
	<div style="margin-left:auto; margin-right:auto; width:100%;">
		@if( Auth::user()->rol=='Administrator' && Helper::checkFinishedProject($iteration->projects->id)=='MENOR' )
			<div id="story_form" class="story_form" style="margin-left:auto; margin-right:auto">
				<!-- inicio -->
				<div id="mainError" class="alert alert-error" style="visibility:hidden;">  
	            </div>  
				<div id="issueError">
				</div>
				<!-- fin -->
				<ul id="createdStories">
				</ul>
				<div id="addStoryFormOnProgress" class="hidden">Guardando historia.  Por favor espere...</div> 
				{{ Form::open(array('url'=>'issue','class'=>'uniForm', 'id'=>'addStoryForm')) }}
				<textarea id="summary" rows="1" cols="50" name="summary" maxlength="5000" placeholder="Resumen"></textarea>
				@if(Auth::user()->rol=='Administrator')
					<button id="add_button" type="submit" class="btn">Agregar historia</button>
				@endif
				<div class="iteration-app">
					@include('layouts.issue.form')
				</div>
				{{ Form::close() }}
			</div>
		@endif
		<h1>Historia</h1>
		<ul id="tour-story-list" class="story-list ui-sortable" style="">
			@foreach ($issues as $issue)
			<li class="story-view superboard-story story_block gripper-status-1" story_id="863903" id="superboard_story_863903" rank="499999">
				<div class="story-checkbox-holder" style="display: none;">
					<input type="checkbox" class="story-checkbox">
				</div>
				<div class="block_story_body story-border">
					<div class="story-content">
						<span class="story-icons">
							<a href="#" class="moveIterationIcon" story_id="863903">
								<i class="icon-glyph icon-share" title="Move to another iteration."></i>
							</a> 
							<a href="#" class="story-status-button">
								<i class="icon-glyph icon-tag" title="Change story status."></i>
							</a>    
							<a href="#" class="edit-story-button">
								<i class="icon-glyph icon-edit" title="Edit story"></i>
							</a>  
						</span>
						<h1 class="formatted_story_text story-summary">
							<span style="color:#555555;" class="story_number">#</span>
							<p>{{ $issue->summary }}</p>
						</h1>
						<div class="formatted_story_text story_detail">
							<p>{{ $issue->detail }}</p>
						</div>
					</div>	
					<div class="story_footer">    
					@if($hasmembers)
					<span class="tasks-holder">
						<span>
							<a class="status-text label-task status-background-1 status-foreground-1" href="#myModal" onclick="mostrarTaskboard({{ $issue->id }}, {{ Auth::user()->id }}, '{{ Auth::user()->rol }}')">
								Tareas
							</a>
						</span>
					</span>
					@endif
				</div>
			</div>
		</li>
		@endforeach
	</ul>
</div>
@else
<div class="alert alert-warning alert-dismissable"> 
	<strong>Advertencia!</strong>  No tiene usuarios asignados al proyecto. <a href="/projects/members/{{ $project->id }}">Asignar</a>	
</div>	
@endif
</div>
<div sytle="clear:both"></div>

<!-- DIALOGOS: MATERIAL, PERSONAL, GASTOS ADICIONALES, TAREAS -->
@include('layouts.iterations.dialogs')
<!-- Permite manejar el evento de teclado para aparicion de formulario de nueva historia -->
<script type="text/javascript">

$("#summary").keypress(function() { 
	$("#story_details").show( "slow" );
});	

$(".add_category_link").click(function() {
	$(this).css('display', 'none');
	$("#categoryid").css( "display","none" );
	$(".category_name").css( "display","block" ); 
});

var rol = "{{  Auth::user()->rol; }}" ;
var finished = "{{  Helper::checkFinishedProject($project->id); }}" ;
createProjMenu("{{ $project->id }}", rol, finished);
</script>