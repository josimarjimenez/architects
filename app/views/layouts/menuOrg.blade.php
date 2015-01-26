	{{ HTML::link('#', $organization->name, array('class'=>'drop megamenu-top-header','id'=>'organization')) }}
	<div id="options" class="drop8columns dropcontent pull-left-450" style="left: auto; display: block; max-height: 639px;">
		<h3 class="col_8">{{ $organization->name }}</h3>  
		<div class="col_8"> 
			<ul class="project-menu-horizontal-list">
				<li> 
					<a href="/users/dashboard" title="Ver todas las iteraciones">
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
					<a href="/projects/{{ $organization->auxName }}/releases" title="Roll up work across projects into releases.">
						<i class="topmenu-icon icon-glyph icon-calendar-empty"></i> Entregables
					</a>
				</li>


				<li>
					<a href="/organization/members/{{ $organization->auxName }}/all_members" title="Get a listing of all members of the organization.">
						<i class="topmenu-icon icon-glyph icon-group"></i> 
						Miembros 
					</a>
				</li>

				<li>
					<a href="/materials" title="Lista de materiales en la organización">
						<i class="topmenu-icon icon-glyph icon-group"></i> 
						Material 
					</a>
				</li>

				<li>
					<a href="/personalType" title="Lista de tipo depersonal en la organización">
						<i class="topmenu-icon icon-glyph icon-group"></i> 
						Tipo de personal 
					</a>
				</li>
				
				<li>
					<a href="/taskBoard" title="Lista de materiales en la organización">
						<i class="topmenu-icon icon-glyph icon-group"></i> 
						Task board
					</a>
				</li>

				<li>
					<a href="/organization/{{ $organization->auxName }}/edit">
						<i class="topmenu-icon icon-glyph icon-cogs"></i> 
						Editar organización</a>
				</li>

			</ul>

		</div>

		<h3 class="col_8">Proyectos</h3> 
		<div class="col_8">
			<ul>  
				@foreach ($organization->projects as $project)
				<li class="project-menu-iteration-list-item ">
					<a class="organization-project-link" href="/projects/{{ $project->id }}">
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