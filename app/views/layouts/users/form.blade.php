<br><br>
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>

<div id="projectError">
	@if($errors->all())
	<ul class="alert alert-error">
		@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
	@endif 
	<h1>Crear/Editar Usuarios</h1>
	<div class="panel">
		<?php 
		if($type == "new"){
			?>
			{{ Form::open(array('url'=>'users/create','files'=>true,  'class'=>'uniForm')) }}
			
			<?php }else { ?>
				{{ Form::open(array('url'=>'users/edit/'.$user->id,'class'=>'uniForm')) }}
			<?php } ?>
			<fieldset class="inlineLabels">
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('name', 'Nombre' , array('class'=>'requiredField' )) }}
					{{ Form::text('nombres', null, array('class'=>'textInput textinput', 'placeholder'=>'Nombres')) }}
				</div>
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('value', 'Apellidos', array('class'=>'requiredField' )) }}
					{{ Form::text('apellidos', null, array('class'=>'textInput textinput', 'placeholder'=>'Apellidos')) }}
				</div>
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('value','Identificación', array('class'=>'requiredField'))}}
					{{ Form::text('identification',null,array('classs'=>'textInput textinput', 'placeholder'=>'Identificación',
					'id'=>'ident'))}}
				</div>
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('value','Teléfono', array('class'=>'requiredField'))}}
					{{ Form::text('telefono', null, array('class'=>'textInput textinput', 'placeholder'=> 'Teléfono'))}}
				</div>
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('value', 'Correo', array('class'=>'requiredField' )) }}
					{{ Form::text('mail', null, array('class'=>'textInput textinput', 'placeholder'=>'Dirección de correo')) }}
				</div>
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('value', 'Dirección', array('class'=>'requiredField' )) }}
					{{ Form::text('direccion', null, array('class'=>'textInput textinput', 'placeholder'=>'Dirección')) }}
				</div>


				<div class="ctrlHolder" id="div_id_function">
					{{ Form::label('value', 'Función', array('class' => 'requiredField')) }}
					<select name="functionid" id="functionid">
		              <option value="0">----</option>
		              @foreach ($functions as $function)
		                @if($function->id == $idFunction)
		                  <option value="{{ $function->id }}" selected>{{ $function->name }} </option>
		                @else
		                  <option value="{{ $function->id }}" >{{ $function->name }} </option>
		                @endif
		              @endforeach
		            </select>   
		            <a class="add_function_link" href="#">Agregar función</a>
		            <input name="function_name" class="function_name" maxlength="25" style="display:none" type="text">
				</div>

				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('value', 'Password', array('class'=>'requiredField' )) }}
					{{ Form::password('password', array('class'=>'textInput textinput', 'placeholder'=>'Contraseña')) }}
				</div>
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('value', 'Password confirmación', array('class'=>'requiredField' )) }}
					{{ Form::password('password_confirmation', array('class'=>'textInput textinput', 'placeholder'=>'Confirm contraseña')) }}
				</div> 

				<div class="ctrlHolder" id="logtipo">
					{{ Form::label('image', 'Avatar',array('class'=>'requiredField' )) }}
					@if ( !empty($user->avatar) )
						{{ HTML::image("uploads/users/".$user->avatar,
							'alt', 
							array(
								'width' => 120, 
								'height' => 70 
								)
							)
						 }}
					@endif
					{{ Form::file('image')  }}	 
				</div>
				<!--
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('image', 'Logotipo') }}
					{{ Form::file('image')  }}	 
				</div>
				!-->

				<div class="buttonHolder">
					
					{{ HTML::link('/organization/members/' . $organization->auxName . '/all_members/',  'Cancelar', array('class'=>"btn btn-danger btn-sm")  ) }} 

					{{ Form::submit('Guardar  ', array('class'=>'btn btn-primary'))}}
				</div>
				{{ Form::hidden('organizationid', $organization->id) }}
			</fieldset>
			{{ Form::close() }}
		</div>
	</div>

	<script type="text/javascript">
	
	$(".add_function_link").click(function() {
		$("#functionid").val("0");
		$(this).css('display', 'none');
		$("#functionid").css( "display","none" );
		$(".function_name").css( "display","block" ); 
	});


	$(function() {
		
		$( "#price" ).keyup(function () { 
			$(this).val($(this).val().replace(/[^0-9\.]/g,''));
			if($(this).val().split(".")[2] != null || ($(this).val().split(".")[2]).length ){
				$(this).val($(this).val().substring(0, $(this).val().lastIndexOf(".")));
			}   
		});

		$('#ident').keyup(function (){
            this.value = (this.value + '').replace(/[^0-9]/g, '');
        });

		$('#telefono').keyup(function (){
            this.value = (this.value + '').replace(/[^0-9]/g, '');
        });

	});
	</script>


	<script type="text/javascript">
	function validate() {
			//$(function(){
	  
	  /**
	     * Algoritmo para validar cedulas de Ecuador
	     * @Author : Victor Diaz De La Gasca.
	     * @Fecha  : Quito, 15 de Marzo del 2013 
	     * @Email  : vicmandlagasca@gmail.com
	     * @Pasos  del algoritmo
	     * 1.- Se debe validar que tenga 10 numeros
	     * 2.- Se extrae los dos primero digitos de la izquierda y compruebo que existan las regiones
	     * 3.- Extraigo el ultimo digito de la cedula
	     * 4.- Extraigo Todos los pares y los sumo
	     * 5.- Extraigo Los impares los multiplico x 2 si el numero resultante es mayor a 9 le restamos 9 al resultante
	     * 6.- Extraigo el primer Digito de la suma (sumaPares + sumaImpares)
	     * 7.- Conseguimos la decena inmediata del digito extraido del paso 6 (digito + 1) * 10
	     * 8.- restamos la decena inmediata - suma / si la suma nos resulta 10, el decimo digito es cero
	     * 9.- Paso 9 Comparamos el digito resultante con el ultimo digito de la cedula si son iguales todo OK sino existe error.     
	     */
	 
	     //var cedula = '0931811087';
	    var cedula = $('#ident').val();
	 
	     //Preguntamos si la cedula consta de 10 digitos
	    if(cedula.length == 10){
	        
	        //Obtenemos el digito de la region que sonlos dos primeros digitos
	        var digito_region = cedula.substring(0,2);
	        
	        //Pregunto si la region existe ecuador se divide en 24 regiones
	        if( digito_region >= 1 && digito_region <=24 ){
	          
	          // Extraigo el ultimo digito
	          var ultimo_digito   = cedula.substring(9,10);
	 
	          //Agrupo todos los pares y los sumo
	          var pares = parseInt(cedula.substring(1,2)) + parseInt(cedula.substring(3,4)) + parseInt(cedula.substring(5,6)) + parseInt(cedula.substring(7,8));
	 
	          //Agrupo los impares, los multiplico por un factor de 2, si la resultante es > que 9 le restamos el 9 a la resultante
	          var numero1 = cedula.substring(0,1);
	          var numero1 = (numero1 * 2);
	          if( numero1 > 9 ){ var numero1 = (numero1 - 9); }
	 
	          var numero3 = cedula.substring(2,3);
	          var numero3 = (numero3 * 2);
	          if( numero3 > 9 ){ var numero3 = (numero3 - 9); }
	 
	          var numero5 = cedula.substring(4,5);
	          var numero5 = (numero5 * 2);
	          if( numero5 > 9 ){ var numero5 = (numero5 - 9); }
	 
	          var numero7 = cedula.substring(6,7);
	          var numero7 = (numero7 * 2);
	          if( numero7 > 9 ){ var numero7 = (numero7 - 9); }
	 
	          var numero9 = cedula.substring(8,9);
	          var numero9 = (numero9 * 2);
	          if( numero9 > 9 ){ var numero9 = (numero9 - 9); }
	 
	          var impares = numero1 + numero3 + numero5 + numero7 + numero9;
	 
	          //Suma total
	          var suma_total = (pares + impares);
	 
	          //extraemos el primero digito
	          var primer_digito_suma = String(suma_total).substring(0,1);
	 
	          //Obtenemos la decena inmediata
	          var decena = (parseInt(primer_digito_suma) + 1)  * 10;
	 
	          //Obtenemos la resta de la decena inmediata - la suma_total esto nos da el digito validador
	          var digito_validador = decena - suma_total;
	 
	          //Si el digito validador es = a 10 toma el valor de 0
	          if(digito_validador == 10)
	            var digito_validador = 0;
	 
	          //Validamos que el digito validador sea igual al de la cedula
	          if(digito_validador == ultimo_digito){
	            console.log('la cedula:' + cedula + ' es correcta');
	            alert('la cedula:' + cedula + ' es correcta');
	          }else{
	            console.log('la cedula:' + cedula + ' es incorrecta');
	            alert('la cedula:' + cedula + ' es incorrecta');
	            var cedula = $('#ident').val();
	            $('#ident').val('');
	          }
	          
	        }else{
	          // imprimimos en consola si la region no pertenece
	          console.log('Esta cedula no pertenece a ninguna region');
	          alert('Esta cedula no pertenece a ninguna region');
	          $('#ident').val('');
	        }
	    }else{
	        //imprimimos en consola si la cedula tiene mas o menos de 10 digitos
	        //console.log('Esta cedula tiene menos de 10 Digitos');
	        console.log('Su cédula no contiene 10 dígitos');
	        alert('Su cédula no contiene 10 dígitos');
	       	$('#ident').val('');
	    }    
	}
</script>