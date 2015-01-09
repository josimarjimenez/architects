<div class="main-content">
	<div class="project-body-header">
		<h1 id="tour-project-name">
			{{ $project->name }}
		</h1>
		<div class="project-body-header-stats">
			<div class="stats-bubble">
				Total Stories
				<h4>0</h4>
			</div>
			<div class="stats-bubble">
				Stories Completed
				<h4>0</h4>
			</div>
			<div class="stats-bubble">
				Stories In Progress
				<h4>0</h4>
			</div>
		</div>
	</div>
	<br><br>
		@if($iterations < 1)
			{{ Form::open(array('url' => 'iterations/create', 'method'=>'GET','class' => 'pull-right')) }}
				{{ Form::hidden('projectid', $project->id) }}
				{{ Form::submit('Nueva iteración', array('class' => 'button green large')) }}
			{{ Form::close() }}
		@else
			<div style="margin-left:auto; margin-right:auto" class="story_form" id="story_form">
				<ul id="createdStories"></ul>
				<div class="hidden" id="addStoryFormOnProgress">Guardando historia. Por favor espere...</div>
				<form id="addStoryForm" method="POST">
					<textarea maxlength="5000" name="summary" cols="50" rows="1" id="id_summary" style="height: 50px;"></textarea>    
					<button class="btn" type="submit" id="add_button">Agregar historia</button>
				</form>
			</div>
		@endif 
</div>