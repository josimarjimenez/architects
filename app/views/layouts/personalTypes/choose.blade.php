<div style="width:95%; margin: 0 auto;">
	<p></p>
	<h1>Lista de personal</h1>
	<p></p>
	<table class="table table-striped"  >
	<tr>
		<td><h2>Nombre</h2></td>
		<td><h2>Valor</h2></td>
		<td></td>
	</tr>
	@foreach($personal as $per)
		<tr>
	    	<td>{{ $per->name }}</td>
	    	<td align="right">$ {{ $per->hourCost }}</td>
	    	<td>
	    		<a href="#" onclick="udpateMaterial({{ $per->id }}, '{{ $per->name }}', {{ $per->hourCost }})">Seleccionar</a>
	    	</td>
	    </tr>
	@endforeach
	</table>
</div>