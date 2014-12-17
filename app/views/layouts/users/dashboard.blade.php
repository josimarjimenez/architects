 <br><br>
 <h1 id="tour-org-name">{{ $organization->name }}</h1>
 <div id="report">
 	<div class="report-tab-holder">
 		<div class="report-tab"><a href="#" id="yourstats">Your Stats</a></div>
 		<div class="report-tab report-tab report-tab-selected"><a href="#" id="summary">Organization Stats</a></div>
 		<div class="report-tab"><a href="#" id="points_breakdown">Point Breakdown</a></div>

 		<div class="report-tab"><a href="#" id="velocity">Organization Velocity</a></div>			
 	</div>
 	<div id="report_area" style="min-height: 92px;"><div class="stats-bubble">
 		Proyectos
 		<h4>{{ $projectsCount }}</h4> 
 	</div>

 	<div class="stats-bubble">
 		Total de historias
 		<h4>{{ $iterationsCount }}</h4> 
 	</div>

 	<div class="stats-bubble">
 		Total tareas
 		<h4>0</h4> 
 	</div> 
 </div>
</div>

<div class="my-dashboard-holder">
	<div class="mydashboard">
		<ul class="dash-project-list">
			@foreach ($organization->projects as $project)
      			<li class="dash-project">
      				<div class="dash-proj-title">
      					{{ $project->name }}
      					<span class="right-aligned-links">
      						<a href="/projects/project/{{$project->name}}/summary"><i data-original-title="resumen proyecto" class="icon-globe tooltip-enabled" title=""></i></a>
      					</span>
      				</div>
      				<ul class="dash-iteration-list">
      				@foreach ($project->iterations as $iteration)
      					<li>
      						<div class="dash-iter-title">
      							<b class="dash-iter-name">{{ $iteration->name }}</b>
      							<i class="dash-iter-dates">{{ $iteration->start }} - {{  $iteration->end }}</i>
      							<span class="right-aligned-links">
        							<a href="/iterations/{{ $iteration->id }}" title="" class="tooltip-enabled" data-original-title="lista de historias"><i class="icon-glyph icon-reorder"></i></a>
       							 	<a href="/iterations/{{ $iteration->id }}/board" title="" class="tooltip-enabled" data-original-title="Scrum Board"><i class="icon-glyph icon-th"></i></a>
    							</span>
      						</div>
      						<table class="dash-iter-table">
      							<tbody>
      								<tr>
      									<td class="dash-iter-left">
      										{{ HTML::image('images/sprint1.png') }}
      									</td>
      									<td class="dash-iter-right">
      										<span class="recent-stories" style="display: inline;">Modificados recientemente:</span>
      										<ul class="dash-iter-stories">            
            <li class="story-view story-style-list superboard-story story_block gripper-status-4" story_id="774524" id="superboard_story_774524" rank="5075"><div class="story-checkbox-holder" style="display: none;">
<input type="checkbox" class="story-checkbox">
</div>


    
    
    <span class="story-icons">
        

        
        
            
            
            <a href="#" class="edit-story-button"><i class="icon-glyph icon-edit" title="Edit story"></i></a>

        
    </span>

    
    <h1 class="formatted_story_text"><span style="color:#555555;" class="story_number">#3</span> <p>Migracion de metadata y de archivos de DSpace v1.42 a 4.1</p></h1>
    
</li><li class="story-view story-style-list superboard-story story_block gripper-status-10" story_id="774523" id="superboard_story_774523" rank="502518"><div class="story-checkbox-holder" style="display: none;">
<input type="checkbox" class="story-checkbox">
</div>


    
    
    <span class="story-icons">
        

        
        
            
            
            <a href="#" class="edit-story-button"><i class="icon-glyph icon-edit" title="Edit story"></i></a>

        
    </span>

    
    <h1 class="formatted_story_text"><span style="color:#555555;" class="story_number">#2</span> <p>Instalacion de DSpace 4.1 o 4.2 (version estable)</p></h1>
    
</li><li class="story-view story-style-list superboard-story story_block gripper-status-10" story_id="774520" id="superboard_story_774520" rank="502499"><div class="story-checkbox-holder" style="display: none;">
<input type="checkbox" class="story-checkbox">
</div>


    
    
    <span class="story-icons">

            <a href="#" class="edit-story-button"><i class="icon-glyph icon-edit" title="Edit story"></i></a>

        
    </span>

    
    <h1 class="formatted_story_text"><span style="color:#555555;" class="story_number">#1</span> <p>Reparar Dspace v1.42</p></h1>
    
</li></ul>
      									</td>
      								</tr>
      							</tbody>
      						</table>

      					</li>	
      				@endforeach 
      				</ul>
      			</li> 
    		@endforeach 
		</ul>
	</div>
</div>

<div id="selectOrganization">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Seleccione la organización</h3>
		</div>
		<div class="panel-body">
			<ul>
				<li>
					<h3>
						{{ HTML::linkAction('OrganizationsController@getIndex', 'Mi empresa 1')}}
					</h3>
					<div>8 Projectos - 2 Equipos</div>
				</li>
				<li>
					<h3><a href="">Mi empresa 2</a></h3>
					<div>2 Projectos - 1 Equipo(s)</div>
				</li>
			</ul>
			{{ HTML::linkAction('OrganizationsController@getNew', 'Crear nueva organización', 
				array(), 
				array('class'=>'btn btn-success'))}}
			</div>
		</div>
	</div>

