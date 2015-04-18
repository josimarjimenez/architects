@if(Auth::user()->rol=='Administrator')
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
	<br>
	@if($iterations < 1)
	{{ Form::open(array('url' => 'iterations/create', 'method'=>'GET','class' => 'pull-right')) }}
	{{ Form::hidden('projectid', $project->id) }}
	{{ Form::submit('Nueva iteración', array('class' => 'button green large')) }}
	{{ Form::close() }}
	@else
	<div style="margin-left:auto; margin-right:auto" class="story_form" id="story_form">
		<ul id="createdStories"></ul>
		<div class="hidden" id="addStoryFormOnProgress">Guardando historia. Por favor espere...</div>
		@if(Auth::user()->rol=='Administrator')
			<form id="addStoryForm" method="POST">
				<textarea maxlength="5000" name="summary" cols="50" rows="1" id="id_summary" style="height: 50px;"></textarea>    
			<button class="btn" type="submit" id="add_button">Agregar historia</button>
			</form>
		@endif
	</div>
	<div style="margin-left: auto; margin-right: auto; padding: 0px; position: relative;" id="overallBurndown">
		<?php echo HTML::image('images/graficoProy.png'); ?> 
	</div>
	@endif 
</div>
@endif

<script type="text/javascript">
$( document ).ready(function() { 
	var pathname = window.location.pathname.split("/");
	var id = pathname[pathname.length-1];
 	$.ajax({
		type: 'GET',
		url:  'http://localhost:8000/ajax/getProject',
		data: 'id='+id,
		beforeSend: function(){
		},
		success: function (data) { 
			var project = data.project;
			var iterations = data.iterations;

			$('#navbar-project-menu').html('');
			var li =  '<a id="projectMenu" class="drop project-dropdown-menu megamenu-top-header" href="#">'+project.name+'</a>';
			li += '<div id="subMenuProject" class="drop8columns dropcontent pull-left-450 white-dropdown" style="margin-left: -380px !important; left: auto; display: block; max-height: 385px;">'; 
			li +='<h3 class="col_8">'+project.name+'<span style="float:right">';
			li +='<a remove_url="/favorites/remove/1/44062" add_url="/favorites/add/1/44062" href="#" class="black-link favorite_link" title="Toggles whether or not this project is watched.">	';
			li += ' <i class="icon-eye-close"></i>';
			li +='</a>';
			li +='</span></h3>';

			li += '<div class="col_6">';
			li += '<ul class="project-menu-horizontal-list">';
			//resumen de proyecto
			li += '<li>';
			li += '<a id="summaryProject" href="/projects/'+id+'">';
			li += '<i class="topmenu-icon icon-home"> </i> Resumen';
			li +='</a>';
			li +='</li>';
 
			//administracion proyecto
			li +='<li>';
			li +='<a href="/projects/'+id+'/edit" title="">';
			li +='<i class="topmenu-icon icon-glyph icon-edit"></i> Admin. del proyecto';
			li +='</a>';
			li +='</li>';

			//grupo de trabajo 
			li +='<li>';
			li +='<a href="/projects/members/'+id+'" title="Grupo de trabajo">';
			li +='<i class="topmenu-icon icon-glyph icon-group"></i> Grupo de trabajo';
			li +='</a>';
			li +='</li>';
			li += '</ul>';
			li += '</div>';


			li += '<h3 class="col_8">Iteraciones</h3>';
			li += '<div class="col_6">';
			li += '<ul class="project-menu-iteration-list" id="iteracionesList">';
			$.each( iterations, function( key, value ){

				li += '<li class="project-menu-iteration-list-item ">';
				li += '<a href="/iterations/'+value.id+'">'+value.name+'<br>';
				li += '<i></i>';
				li += '</a>';
				li += '</li>'; 
			});

			li += '</ul>'; 
			li += '</div>';
			li += '<div style="clear:both"></div>'
			li += '<div style="margin-left:10px">'
				li += '<form action="/iterations/create" method="get" class="pull-left">';
				li += '<input type="hidden" name="projectid" value="'+project.id+'" />';
				li += '<input type="submit"   value="Nueva iteración" class="button green large" />';
				li +='</form>';
			li +='</div>'
			li += '</div>';

			$('#navbar-project-menu').append(li);
			$('#navbar-project-menu').css('display', 'block');
			$('#subMenuProject').css('display', 'none');

			$('#projectMenu').click(function() {
			    $( "#subMenuProject" ).toggle(); 
				$('#options').css('display', 'none');
			});
		}
	});

	
});

</script>