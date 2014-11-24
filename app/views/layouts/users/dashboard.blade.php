 <br><br>
<div id="selectOrganization">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Seleccione la organización</h3>
		</div>
		<div class="panel-body">
			<ul>
				<li>
					<h3><a href="">Mi empresa 1</a></h3>
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

