<div style="width:95%; margin: 0 auto;">
	<p></p>
	<h1>Lista de materiales</h1>
	<p></p>
	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
               <td><h2>Nombre</h2></td>
                <td><h2>Valor</h2></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach($materiales as $material)
                <tr>
                    <td>{{ $material->name }}</td>
                    <td align="right">$ {{ $material->value }}</td>
                    <td><a href="#" onclick="udpateMaterial({{ $material->id }}, '{{ $material->name }}', {{ $material->value }})">Seleccionar</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>	
</div>

<script type="text/javascript">
	$(document).ready(function() {
    	//$('#example').dataTable();
        $('#example').DataTable( {
            language: {
                url: '/packages/js/Spanish.json'
            }
        } );
	} );
</script>