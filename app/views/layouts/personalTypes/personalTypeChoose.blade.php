<div style="width:95%; margin: 0 auto;">
	<p></p>
	<h1>Lista de personal</h1>
	<p></p>
	<table id="personal" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
               <td><h2>Nombre</h2></td>
                <td><h2>Valor</h2></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
           @foreach($personal as $per)
                <tr>
                    <td>{{ $per->name }}</td>
                    <td align="right">$ {{ $per->hourCost }}</td>
                    <td>
                        <a href="#" onclick="udpatePersonal({{ $per->id }}, '{{ $per->name }}', {{ $per->hourCost }})">Seleccionar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>	
</div>
<script type="text/javascript">
	$(document).ready(function() {
    	//$('#example').dataTable();
        $('#personal').DataTable( {
            language: {
                url: '/packages/js/Spanish.json'
            }
        } );
	} );
</script>