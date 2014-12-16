@if(!Auth::check())
<li class="right">
	{{ HTML::link('users/register', 'Register', array('class'=>'drop megamenu-top-header')) }} 
</li>
<li class="right">
	{{ HTML::link('users/login', 'Iniciar sesión', array('class'=>'drop megamenu-top-header')) }}
</li>

@else
<li class="right">
	{{ HTML::link('users/logout', 'Cerrar sesión',array('class'=>'drop megamenu-top-header')) }}
</li>
<li class="right">
	{{ HTML::link('#', $organization->name, array('class'=>'drop megamenu-top-header','id'=>'organization')) }}

	<div id="options" class="drop8columns dropcontent pull-left-450" style="left: auto; display: block; max-height: 639px;">
		<h3 class="col_8">{{ $organization->name }}</h3>  
		<div class="col_8">
			<ul class="project-menu-horizontal-list">
				<li> 
					<a href="/organization/name/{{ $organization->auxName }}/dashboard" title="Ver todas las iteraciones">
						<i class="topmenu-icon icon-globe"> </i>
						Escritorio
					</a>
				</li>

				<li>
					<a href="/organization/name/{{ $organization->auxName }}/projects" title="See the list of projects.">
						<i class=" icon-briefcase"></i> 
						Proyectos
					</a>
				</li>

				<li>
					<a href="/organization/{{ $organization->auxName }}/teams" title="See and manage who works on what.">
						<i class="topmenu-icon icon-glyph icon-group"></i> 
						Equipos
					</a>
				</li>
 
				<li>
					<a href="/projects/{{ $organization->auxName }}/releases" title="Roll up work across projects into releases.">
						<i class="topmenu-icon icon-glyph icon-calendar-empty"></i> Entregables
						</a>
				</li>


				<li>
					<a href="/organization/{{ $organization->auxName }}/all_members" title="Get a listing of all members of the organization.">
						<i class="topmenu-icon icon-glyph icon-group"></i> 
						Miembros 
					</a>
				</li>

				<li>
					<a href="/organization/{{ $organization->auxName }}/edit"><i class="topmenu-icon icon-glyph icon-cogs"></i> Editar organización</a>
				</li>

			</ul>
		</div>

		<h3 class="col_8">Proyectos</h3> 
		<div class="col_8">
			<ul>
				@foreach ($organization->projects as $project)
      				<li class="project-menu-iteration-list-item ">
      					<a class="organization-project-link" href="/projects/project/dspace/">
      					{{ $project->name }}
      					</a>
      				</li>
    			@endforeach 
			</ul>
		</div>            
		<div style="text-align:right" class="col_8">
			<a href="/orgs?force_org_view=1" class="btn btn-primary btn-small">Switch Organization</a>
		</div>
	</div>
</li>

@endif