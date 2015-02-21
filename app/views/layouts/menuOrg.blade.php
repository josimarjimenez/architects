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
					<a id="proyectID" onclick="setProject({{ $project->id }})"   class="organization-project-link" href="#" >
						{{ $project->name }}
					</a>
				</li>
				@endforeach 
			</ul>
		</div>   
	</div> 

	<script type="text/javascript">
		function setProject(id){
			$('#summaryProject').attr('href', '/projects/project/'+id);
			$.ajax({
				type: 'GET',
		        url:  'http://localhost:8000/ajax/getProject',
		        data: 'id='+id,
                beforeSend: function(){
                    //$('.before').append('<img src="images/loading.gif" />');
                },
                success: function (data) { 
                	var project = data.project;
                	var iterations = data.iterations;
                	

                	$('#navbar-project-menu').html('');
                	var li =  '<a id="projectMenu" class="drop project-dropdown-menu megamenu-top-header" href="#">'+project.name+'</a>';
					li += '<div id="subMenuProject" class="drop8columns dropcontent pull-left-450 white-dropdown" style="left: auto; display: block; max-height: 385px;">'; 
					li +='<h3 class="col_8">'+project.name+'<span style="float:right">';
						li +='<a remove_url="/favorites/remove/1/44062" add_url="/favorites/add/1/44062" href="#" class="black-link favorite_link" title="Toggles whether or not this project is watched.">	';
						li += ' <i class="icon-eye-close"></i>';
						li +='</a>';
					li +='</span></h3>';



					li += '<div class="col_8">';
					li += '<ul class="project-menu-horizontal-list">';
						li += '<li>';
							li += '<a id="summaryProject" href="/projects/'+id+'">';
		        				li += '<i class="topmenu-icon icon-globe"> </i>Resumen del proyecto';
		      				li +='</a>';
	   	 				li +='</li>';
	   	 				li +='<li>';
      						li +='<a href="/projects/project/adfadf/admin" title="Project Administration / Settings">';
        						li +='<i class="topmenu-icon icon-glyph icon-cogs"></i>Administración del proyecto';
      						li +='</a>';
    					li +='</li>';
					li += '</ul>';
					li += '</div>';
 
					 /*
					li += '<h3 class="col_8">Backlog</h3>';
					li += '<div class="col_8">';
	  					li += '<ul class="project-menu-horizontal-list">';
	    					li += '<li>';
	    					li += '<a href="/projects/project/adfadf/iteration/117851">';
	    					li += '<i class="topmenu-icon icon-glyph icon-list"></i>Lista de historias';
						    li +=  '</a>';
						    li +='</li>';
			         	li += '</ul>';
					li += '</div>';*/
					 
					li += '<h3 class="col_8">Iteraciones</h3>';
						li += '<div class="col_8">';
							li += '<ul class="project-menu-iteration-list" id="iteracionesList">';
								$.each( iterations, function( key, value ){
									console.log(value.id);
									li += '<li class="project-menu-iteration-list-item ">';
										li += '<a href="/iterations/'+value.id+'">'+value.name+'<br>';
											li += '<i></i>';
										li += '</a>';
									li += '</li>'; 
								});
									
								li += '</ul>'; 
								li += '<form action="/iterations/create" method="get" class="pull-right">';
      								li += '<input type="hidden" name="projectid" value="'+project.id+'" />';
      								li += '<input type="submit"   value="Nueva iteración" class="button green large" />';
								li +='</forms>';
								li += '</div>';
					li += '</div>';
		  
                	$('#navbar-project-menu').append(li);
                	$('#navbar-project-menu').css('display', 'block');
                	$('#options').css('display', 'none');
                }
            });
		}
</script>