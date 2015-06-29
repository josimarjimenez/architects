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
	<br><br>
	@if(!sizeof($project->team->users) > 0)
		<h2>Crea un grupo de trabajo par empezar!</h2>
		{{ HTML::link('/projects/members/'.$project->id, 'Grupo de trabajo', array('class' => 'button green large', 'id' =>'newGroup'))}}
	@endif

	@if($iterations < 1)
		{{ Form::open(array('url' => 'iterations/create', 'method'=>'GET','class' => 'pull-center')) }}
		{{ Form::hidden('projectid', $project->id) }}
		<h2>Aún no has creado iteraciones para crear tu primer iteración ;)</h2>
		{{ Form::submit('Nueva iteración', array('class' => 'button green large')) }}
		{{ Form::close() }}
	@else 
<!--
	<div style="margin-left:auto; margin-right:auto" class="story_form" id="story_form">
		@if(Auth::user()->rol=='Administrator')
		<ul id="createdStories"></ul>
		<div class="hidden" id="addStoryFormOnProgress">Guardando historia. Por favor espere...</div>
			
			<form id="addStoryForm" method="POST">
				<textarea maxlength="5000" name="summary" cols="50" rows="1" id="id_summary" style="height: 50px;"></textarea>    
				<button class="btn" type="submit" id="add_button">Agregar historia</button>
			</form>
		@endif
		</div>-->

		<div id="graphics">
		    <div class="report-tab-holder">
		      <div class="report-tab report-tab-selected">
		        <a href="#" id="yourstats">Gráfico respecto al tiempo</a>
		      </div>
		      <div class="report-tab report-tab ">
		        <a href="#" id="summary">Gráfico respecto al presupuesto</a>
		      </div>
		      <div class="report-tab report-tab">
		        <a href="#" id="historial">Resumen del proyecto</a></div>
		  </div>
		      

		    <div id="report_areaTE" class="print_areaTE" style="min-height: 92px; text-align:center">
				<img src="{{ action('GraphicsIterationController@bar_time', array('project' =>  $project->id)) }}">
				<img src="{{ action('GraphicsIterationController@line_time', array('project' =>  $project->id)) }}">
				
				<div style="text-align:left; font-weight: bold;">
					<p>Tiempo estimado: {{ $estimatedTime }} horas</p>
					<p>Tiempo real: {{ $realTime }} horas</p>
					<p> {{ $resultTime }}</p>
				</div>
				<p><input type="button" id="printer_areaTE" class="btn btn-success" value="Imprimir"></p>

		    </div>

		    <div id="report_areaEO" class="print_areaEO" style="min-height: 92px; text-align:center">
		      	<img src="{{ action('GraphicsIterationController@bar_budget', array('project' =>  $project->id)) }}">
				<img src="{{ action('GraphicsIterationController@line_budget', array('project' =>  $project->id)) }}">
				
				<div style="text-align:left; font-weight: bold;">
					<p>Presupuesto estimado: US$ {{ $estimatedBudget }}</p>
					<p> Presupuesto real: US$ {{ $realBudget }}</p>
					<p> {{ $resultBudget }}</p>
				</div>
				<p><input type="button" id="printer_areaEO" class="btn btn-success" value="Imprimir"></p>

		    </div>

		    <div id="report_areaRP" class="print_areaRP" style="min-height: 92px; text-align:center">
		    	<br>
			   	<div class="table-responsive">
			    	<table width="100%" class="table table-hover" id="summaryTable">
			    		<tr>
			    			<td colspan="5" style="text-align:center">
			    				<h1>Proyecto: {{ $project->name }}</h1>
			    			</td>
			    		</tr>
			    		@if ( !empty($project->iterations()))
							<!-- iteraciones -->
			    			@foreach($project->iterations()->get() as $iteration)
			    				<tr id="toPrint">
			    					<td class="to-iteration" colspan="5" id="iteration-print">
			    						<p  style="text-align:center; font-weight:bold">Iteracion: {{$iteration->name}}</p>
			    						<p  style="text-align:center">({{ $iteration->start}} al {{ $iteration->end}})</p>
			    					</td>
			    				</tr>
			    				<!-- historias -->
			    				@foreach($iteration->issues()->get() as $issue)
			    					<tr>
			    						<td class="to-issue" colspan="5"><strong>Historia:</strong> {{ $issue->summary }}</td>
			    					</tr>
			    					<!-- TAREAS -->
			    					@foreach($issue->tasks()->get() as $task)
			    						<tr>
			    							<td><strong>Actividad:</strong> {{ $task->name }}</td>
											<td colspan="4">
												<!-- MATERIALES -->
												@if (sizeof($task->materials) > 0)
													<table width="100%">
														<tr class="cabecera-print" style="background:#CEEAFA">
															<td width="60%">Materiales</td>
															<td width="10%">Cant.</td>
															<td width="15%">Precio Unit.</td>
															<td width="15%">Total</td>
														</tr>	
														@foreach($task->materials as $material)
														 	<tr>
														 		<td>{{ $material->name }}</td>
														 		<td>{{ $material->pivot->quantity }}</td>
														 		<td>{{ $material->value }}</td>
														 		<td>{{ $material->pivot->total }}</td>
														 	</tr>
														@endforeach
													</table>
												@endif

												<!-- PERSONAL -->
												@if (sizeof($task->typePersonal) > 0)
													<table width="100%"  >
														<tr class="cabecera-print" style="background:#CEEAFA">
															<td width="60%">Personal</td>
															<td width="10%">Cant.</td>
															<td width="15%">Precio Unit.</td>
															<td width="15%">Total</td>
														</tr>	
														@foreach($task->typePersonal as $personal)
														 	<tr>
														 		<td>{{ $personal->name }}</td>
														 		<td>{{ $personal->pivot->quantity }}</td>
														 		<td>{{ $personal->hourCost }}</td>
														 		<td>{{ $personal->pivot->total }}</td>
														 	</tr>
														@endforeach
													</table>
												@endif

												<!-- GASTOS ADICIONALES -->
												@if (sizeof($task->additionalCost) > 0)
													<table width="100%">
														<tr class="cabecera-print" style="background:#CEEAFA">
															<td width="85%" colspan="3">Gastos adicionales</td>
															<td width="15%">Total</td>
														</tr>	
														@foreach($task->additionalCost as $aditional)
														 	<tr>
														 		<td colspan="3">{{ $aditional->description }}</td>
														 		<td>{{ $aditional->total }}</td>
														 	</tr>
													@endforeach
													</table>
												@endif
											</td>			    						
			    						</tr> 
			    					@endforeach
			    				@endforeach
			    				<tr>
									<td colspan="4" class="totalIter">Total de iteración: $ {{ $iteration->realBudget }}</td>
								</tr> 
			    			@endforeach
			    			
			    		@endif
			    	</table> 
				</div>
		        <p><input href="javascript:void(0)" type="button" id="printer_areaRP" class="btn btn-success" value="Imprimir"></p>
		    </div>
		</div>
	@endif 
</div>

<script type="text/javascript">
$( document ).ready(function() 
{ 

	var pathname = window.location.pathname.split("/");
	var id = pathname[pathname.length-1];
	var rol = "{{  Auth::user()->rol; }}" ;
	var finished = "{{  Helper::checkFinishedProject($project->id); }}" ;
	createProjMenu(id, rol, finished); 

	$("#report_areaTE").css( "display", "block" );
    $("#report_areaEO").css( "display", "none" );
    $("#report_areaRP").css( "display", "none" );

    $("#yourstats").click(function() { 
      $(this).parent().addClass( "report-tab-selected" );
      $("#summary").parent().removeClass( "report-tab-selected" );
      $("#historial").parent().removeClass( "report-tab-selected" );

      $("#report_areaTE").css( "display", "block" );
      $("#report_areaEO").css( "display", "none" );
      $("#report_areaRP").css( "display", "none" );
    });

    $("#summary").click(function() { 
      $(this).parent().addClass( "report-tab-selected" );
      $("#yourstats").parent().removeClass( "report-tab-selected" );
      $("#historial").parent().removeClass( "report-tab-selected" );

      $("#report_areaTE").css( "display", "none" );
      $("#report_areaEO").css( "display", "block" );
      $("#report_areaRP").css( "display", "none" );
    });


    $("#historial").click(function() { 
      $(this).parent().addClass( "report-tab-selected" );
      $("#yourstats").parent().removeClass( "report-tab-selected" );
      $("#summary").parent().removeClass( "report-tab-selected" );

      $("#report_areaTE").css( "display", "none" );
      $("#report_areaEO").css( "display", "none" );
      $("#report_areaRP").css( "display", "block" );
    });

});
</script>

<script type="text/javascript">
	$( document ).ready(function()
	{
		//$( ".printer" ).click(function() {
  		//	alert( "Handler for .click() called." );
  		//	$(".print").printArea();
		//});

		$("#printer_areaRP").click(function () {
		  $("div#report_areaRP").printArea();
		})

		//$("#printer_areaRP").bind("click",function()
		//{
		//	$(".print_areaRP").printArea();
		//});

		$("#printer_areaEO").bind("click",function()
		{
			$(".print_areaEO").printArea();
		});

		$("#printer_areaTE").bind("click",function()
		{
			$(".print_areaTE").printArea();
		});

	});
</script>
