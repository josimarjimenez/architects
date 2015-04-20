@if(Auth::user()->rol=='Administrator')
<br><br>
<div id="rolError">
	<ul>
		@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul> 
<h1>Editar Rol</h1>
	<div class="panel">
		{{ Form::model($rol, array('route' => 'rol.udpate', $rol->id)) }}	

			<fieldset class="inlineLabels">
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('name', 'Nombre' , array('class'=>'requiredField' )) }}
					{{ Form::text('name', null, array('class'=>'textInput textinput', 'placeholder'=>'Nombre del Rol')) }}
				</div>
			</fieldset>
		{{ Form::close() }}
	</div>
</div>
@endif

<script type="text/javascript">
$(document).ready(function() {

	$('#startDate').datepicker({
		clearBtn: true,
		calendarWeeks: true,
		autoclose: true,
		todayHighlight: true
	});
	$('#endDate').datepicker({
		clearBtn: true,
		calendarWeeks: true,
		autoclose: true,
		todayHighlight: true
	});

} );
</script>