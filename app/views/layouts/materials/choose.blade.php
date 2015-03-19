<div style="width:80%; margin: 0 auto;">
	<h1>Lista de materiales</h1>
	<table class="table table-bordered table-striped" style="width:80%">
	<tr>
		<td><h2>Nombre</h2></td>
		<td><h2>Valor</h2></td>
		<td></td>
	</tr>
	@foreach($materiales as $material)
		<tr>
	    	<td>{{ $material->name }}</td>
	    	<td align="right">$ {{ $material->value }}</td>
	    	<td><a href="#" onclick="udpateMaterial({{ $material->id }}, '{{ $material->name }}', {{ $material->value }})">Seleccionar</a></td>
	    </tr>
	@endforeach
	</table>
</div>