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

	@if($iterations < 1)
		<h2>Crea un grupo de trabajo par empezar!</h2>
		{{ HTML::link('/projects/members/'.$project->id, 'Grupo de trabajo', array('class' => 'button green large', 'id' =>'newGroup'))}}
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
					<p>Tiempo estimado {{ $estimatedTime }}</p>
					<p>Tiempo real {{ $realTime }}</p>
					<p> {{ $resultTime }}</p>
				</div>
				<p><input type="button" id="printer_areaTE" class="btn btn-success" value="Imprimir"></p>

		    </div>

		    <div id="report_areaEO" class="print_areaEO" style="min-height: 92px; text-align:center">
		      	<img src="{{ action('GraphicsIterationController@bar_budget', array('project' =>  $project->id)) }}">
				<img src="{{ action('GraphicsIterationController@line_budget', array('project' =>  $project->id)) }}">
				
				<div style="text-align:left; font-weight: bold;">
					<p>Presupuesto estimado {{ $estimatedBudget }}</p>
					<p> Presupuesto real {{ $realBudget }}</p>
					<p> {{ $resultBudget }}</p>
				</div>
				<p><input type="button" id="printer_areaEO" class="btn btn-success" value="Imprimir"></p>

		    </div>

		    <div id="report_areaRP" class="print_areaRP" style="min-height: 92px; text-align:center">
		    	 <br>
		    	@if ( !empty($project->iterations()))
			    	<div class="table-responsive">
			    		<table width="100%" class="table table-hover" id="summaryTable">
			    			<tr>
			    				<td rowspan="2"></td>
			    				<td colspan="3" align="center" class="headerTitle">Materiales</td>
			    				<td colspan="3" align="center" class="headerTitle">Personal</td>
			    				<td colspan="3" align="center" class="headerTitle">Gastos adicionales</td>
			    				<td rowspan="2" align="center" class="headerTitle">Total</td>
			    			</tr>
			    			<tr>
			    				<td align="center" class="headerTitle">Unidad</td>
			    				<td align="center" class="headerTitle">Cant.</td>
			    				<td align="center" class="headerTitle">Total</td>

			    				<td align="center" class="headerTitle">Unidad</td>
			    				<td align="center" class="headerTitle">Cant.</td>
			    				<td align="center" class="headerTitle">Total</td>

			    				<td align="center" class="headerTitle">Descript.</td>
			    				<td align="center" class="headerTitle">Total</td>
			    			</tr>
			    		@foreach($project->iterations()->get() as $iteration)
			    			<tr>
			    				<td class="iterationTitle">{{ $iteration->name }} <br>
			    					({{ $iteration->start}} al {{ $iteration->end}})</td>
			    				<td>&nbsp</td>
			    				<td>&nbsp</td>
			    				<td>&nbsp</td>
			    				<td>&nbsp</td>
			    				<td>&nbsp</td>
			    				<td>&nbsp</td>
			    				<td>&nbsp</td>
			    				<td>&nbsp</td> 
			    				<td>&nbsp</td> 
			    				<td>&nbsp</td>
			    			</tr>
			    			
			    			@foreach($iteration->issues()->get() as $issue)
								<tr>
			    					<td align="left" class="issueTable">{{ $issue->summary }}</td>
			    					<td>&nbsp</td>
				    				<td>&nbsp</td>
				    				<td>&nbsp</td>
				    				<td>&nbsp</td>
				    				<td>&nbsp</td>
				    				<td>&nbsp</td>
				    				<td>&nbsp</td>
				    				<td>&nbsp</td>
				    				<td>&nbsp</td>
				    				<td>&nbsp</td>
			    				</tr>
			    				@foreach($issue->tasks()->get() as $task)
									<tr>
										<td align="left" class="taskTable">{{ $task->name }}</td>
										<!-- Materiales -->
										<td colspan="3">
											<table width="100%">
												@foreach($task->materials as $material)
												 	<tr>
												 		<td width="50%">{{ $material->name }}</td>
												 		<td width="15%">{{ $material->pivot->quantity }}</td>
												 		<td>{{ $material->pivot->total }}</td>
												 	</tr>
												@endforeach
											</table>
										</td>
										<!-- Personal -->
					    				<td colspan="3">
					    					<table width="100%">
												@foreach($task->typePersonal as $personal)
												 	<tr>
												 		<td width="50%">{{ $personal->name }}</td>
												 		<td width="15%">{{ $personal->pivot->quantity }}</td>
												 		<td>{{ $personal->pivot->total }}</td>
												 	</tr>
												@endforeach
											</table>
					    				</td>
					    				<!-- Gastos personales -->
					    				<td colspan="2">
					    					<table width="100%">
												@foreach($task->additionalCost as $aditional)
												 	<tr>
												 		<td width="50%">{{ $aditional->description }}</td>
												 		<td width="15%">{{ $aditional->total }}</td>
												 		<td></td>
												 	</tr>
												@endforeach
											</table>
					    				</td>
					    				<td>&nbsp</td>
					    				<td>&nbsp</td>
									</tr>

								@endforeach
								<tr>
									<td colspan="11" class="totalIter">$ {{ $iteration->realBudget }}</td>
								</tr>
			    			@endforeach

			    		@endforeach
			    		</table>
			    	</div>
		    	@endif
		        <p><input type="button" id="printer_areaRP" class="btn btn-success" value="Imprimir"></p>
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
	createProjMenu(id, rol); 

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
		$("#printer_areaRP").bind("click",function()
		{
			$(".print_areaRP").printArea();
		});

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
