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

 	<div class="stats-bubble">
 		Equipos
 		<h4></h4> 
 	</div>

 	<div class="stats-bubble">
 		Overall Velocity
 		<h4>36</h4> 

 	</div>

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

