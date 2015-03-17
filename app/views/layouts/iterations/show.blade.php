 
@if(!empty($message))
<ul id="messages">
	<li id="message_1"><a onclick="$('#message_1').fadeOut(); return false;" href="#"><small>Limpiar</small></a>{{ $message }}</li>
</ul>
@endif
<div class="project-body-header">
	<span class="iteration-board-link">
		<a href="/projects/project/k-gestion/iteration/117871/board">
			<i class="icon-th"></i>Pizarra scrum
		</a>
	</span>
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
			<h4>2</h4> 
		</div>
	</div>
	<div style="text-align:center; margin-top:20px;" id="burnup_chart">
 
		@if($iteration->issues()->count() > 1)
		<img src="{{ action('GraphicsController@iterationSummary' , array('iteration' =>  $iteration->id  )) }}">
		@else
		<img src="https://d11uy15xvlvge3.cloudfront.net/static/v105/scrumdo/images/burndown.png">
		@endif

	</div>	
</div>
<div class="container wide_body" id="body">
	@if($hasmembers)
	<div style="margin-left:auto; margin-right:auto; width:100%;">
		<div id="story_form" class="story_form" style="margin-left:auto; margin-right:auto">
			<ul id="createdStories">
			</ul>
			<div id="addStoryFormOnProgress" class="hidden">Guardando historia.  Por favor espere...</div> 


			
				{{ Form::open(array('url'=>'issue','class'=>'uniForm', 'id'=>'addStoryForm')) }}
				<textarea id="summary" rows="1" cols="50" name="summary" maxlength="5000"></textarea>
				<button id="add_button" type="submit" class="btn">Agregar historia</button>
				<div class="iteration-app">
					@include('layouts.issue.form')
				</div>
				{{ Form::close() }}
		</div>
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
							<span style="color:#555555;" class="story_number">#{{ $issue->id }}</span>
							<p>{{ $issue->summary }}</p>
						</h1>
						<div class="formatted_story_text story_detail">
							<p>{{ $issue->detail }}</p>
						</div>
					</div>	
					<div class="story_footer">    
						<a class="status-text label-task status-background-1 status-foreground-1" 
						href="#">
						{{ $issue->currentState }}
					</a>

					@if($hasmembers)
					<span class="tasks-holder">
						<span>
							<a class="open-tasks-link show_tasks_link" href="#myModal" onclick="mostrarTaskboard({{ $issue->id }})">
								Tareas
							</a>
						</span>
					</span>
					@endif
					|
					<span class="comments-holder">
						<a class="comments-link" href="#">
							0&nbsp;Comments
						</a>
					</span> 
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
<div class="modal" id="taskForm" style="margin-top: 0px; width: 600px; margin-left: -300px; height: 358px; z-index:9100">
	@include('layouts.task.form')
</div>
<div sytle="clear:both"></div>
<div class="modal" id="editTaskForm" style="margin-top: 0px; width: 800px; margin-left: -300px; height: 358px;">
	@include('layouts.task.editForm')
</div>
<div class="modal" id="myModal" style="margin-top: 0px; width: 1340px; margin-left: -670px; height: 496px; z-index:9000">
	@include('layouts.task.taskboard')
</div> 




<script type="text/javascript">
$(document).ready(function() { 
	$("#summary").keypress(function() { 
		$("#story_details").show( "slow" );
	});	

	$(".add_category_link").click(function() {
		$( this ).css('display', 'none');
		$("#categoryid").css( "display","none" );
		$(".category_name").css( "display","block" ); 
	});
});


function mostrarTaskboard(id){
	  	$("#myModal").modal({
	  		// wire up the actual modal functionality and show the dialog
	  		"backdrop" : "static",
	  		"keyboard" : true,
	    	"show" : true 
	    	// ensure the modal is shown immediately
	    }); 

	    
		
		var li = '';
		$.ajax({
            type: 'GET',
            url:  'http://localhost:8000/tareas/taskAll',
            data: 'id='+id,

            success: function (data) {
            	$('.before').hide();
                $('.errors_form').html('');
                $('.success_message').hide().html(''); 
                    
                $('#todo').empty();
                $('#haciendo').empty();
                $('#hecho').empty();

                var tasks = data.tasks; 
                $.each( tasks, function( key, value ) { 
                	alert(value);
                	li = '';
                	li += '<li class="task-view" id="'+value.id+'" >';
	                li += '<span class="task-toolbar">';
	                li += '<a href="#" class="edit-link" onclick="editTask('+value.id+')"> ';
	                li += '<i class="icon-glyph icon-edit" title="Editar tarea"></i>';
	                li += '</a>'
	                li += '<a href="#" class="delete-link">';
	                li += '<i class="icon-glyph icon-trash" title="Borrar tarea"></i>';
	                li += '</a>';
	                li += '</span>';
	                li += value.name+'<br >';
	                li += value.summary;
	                li += '<b> ('+value.usernamere+')</b>';
	                li += '</li>';

					switch(value.scrumid){
						case 1:
						//todo
						$('#todo').append(li);    
						break;
						case 2:
						//haciendo
						$('#haciendo').append(li);    
						break;
						case 3:
						//hecho
						$('#hecho').append(li); 
						break;
					} 
				});       
            },
            error: function(errors){
                $('.before').hide();
                $('.errors_form').html('');
                $('.errors_form').html(errors);
            }
        });
	  	$("#issueid").val(id);
	}

	function mostrarTaskForm(){
	  	$("#taskForm").modal({ // wire up the actual modal functionality and show the dialog
	  		"backdrop" : "static",
	  		"keyboard" : true,
	    	"show" : true // ensure the modal is shown immediately
	    }); 

	    //esconder un panel y  mostrar otro
	    $('#myModal').css('z-index','50');
	}

	function editTask(id){ 
	  	//recover task data
	  	$.ajax({
            type: 'GET',
            url:  'http://localhost:8000/tareas/getTask',
            data: 'id='+id,
            success: function (data) {
            	//alert(data.task.id); 
            	$('#editFormTask #name').val(data.task.name);
            	$('#editFormTask #summary').val(data.task.summary);
            	$('#editFormTask #tags').val(data.task.points);
            	$('#editFormTask #timeEstimated').val(data.task.timeEstimated);
            	$('#editFormTask #issueid').val(data.task.issueid);
            	$('#editFormTask #id').val(data.task.id);	
            },
            error: function(errors){
                $('.before').hide();
                $('.errors_form').html('');
                $('.errors_form').html(errors);
            }
        });

	  	$("#editTaskForm").modal({ // wire up the actual modal functionality and show the dialog
	  		"backdrop" : "static",
	  		"keyboard" : true,
	    	"show" : true // ensure the modal is shown immediately
	    }); 

	  	//esconder un panel y  mostrar otro
	    $('#myModal').css('z-index','50');
	}

</script>