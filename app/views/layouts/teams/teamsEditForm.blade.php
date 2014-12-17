<br><br>
<div id="teamsError">
	<ul>
		@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul> 
<h1>Editar Equipo</h1>
	<div class="panel">
		{{ Form::model($teams, array('route' => 'teams.udpate', $teams->id)) }}	

			<fieldset class="inlineLabels">
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('name', 'Nombre' , array('class'=>'requiredField' )) }}
					{{ Form::text('name', null, array('class'=>'textInput textinput', 'placeholder'=>'Nombre del Equipo')) }}
				</div>
			</fieldset>
		{{ Form::close() }}
	</div>
</div>

<script type="text/javascript">
//$(document).ready(function() {

//	$('#startDate').datepicker({
//		clearBtn: true,
//		calendarWeeks: true,
//		autoclose: true,
//		todayHighlight: true
//	});
//	$('#endDate').datepicker({
//		clearBtn: true,
//		calendarWeeks: true,
//		autoclose: true,
//		todayHighlight: true
//	});

//} );
</script>