<style type="text/css">
#todo, #haciendo, #hecho {
    border: 1px solid #eee; 
    min-height: 20px;
    list-style-type: none;
    margin: 0;
    padding: 5px 0 0 0; 
    margin-right: 10px;
  }
  #todo li, #haciendo li, #hecho li {
    margin: 0 5px 5px 5px;
    padding: 5px;
    font-size: 1.2em; 
  }
</style>
<div class="task-window"   > 
	<div class="modal-header">
        <button aria-hidden="true"
         data-dismiss="modal" class="close" type="button">×</button>
        <h3>Tareas</h3> 
    </div> 
    <div class="modal-body" style="height: 496px;">    
		<div class="tasks-table-header-holder">
			<table class="tasks-header-table">
				<tbody>
					<tr>			
						<th class="status-bg-1">Por hacer</th>		
						<th class="status-bg-4">Haciendo</th> 
						<th class="status-bg-10">Hecho</th>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="tasks-table-holder">
			<table class="tasks-table">
				<tbody>
					<tr>			
						<td>
							<ul data-task-status="1" id="todo" class="connectedSortable task-popup-list ui-sortable" >
							</ul>
						</td> 	
						<td>
							<ul data-task-status="4" id="haciendo"  class="connectedSortable task-popup-list">
							</ul>
						</td>	 	
						<td>
							<ul data-task-status="10"  id="hecho" class="connectedSortable task-popup-list" >
							</ul>
						</td>	 
					</tr>
				</tbody>
			</table>
	</div>

	@if(Auth::user()->rol=='Administrator')
		<div class="modal-footer">
        	<a class="btn btn-success new-task-button" href="#taskForm" onclick="mostrarTaskForm()">Nueva Tarea</a>        
        	<a class="btn" data-dismiss="modal" href="#">Cerrar</a>        
		</div>
	@endif
	
</div>
<script type="text/javascript">
	$(function() {
		position_updated = false; //flag bit

		$( "#todo, #haciendo, #hecho" ).sortable({
	    	connectWith: ".connectedSortable",
	    	items: "li:not(.ui-state-disabled)"
		    start: function(event, ui) {
	            var start_pos = ui.item.index();
	            ui.item.data('start_pos', start_pos);
	        }, 
	        update: function(event, ui){
	        	var id= ui.item.attr('id');
	        	var state = $(this).attr('id'); 
        	 	//params = 'c=' + $(this).attr('id') + '&id=' + ui.item.attr('id');

        		//actiualizacion ajax
        		$.ajax({
		            type: 'GET',
		            url:  'http://localhost:8000/tareas/updateTaks',
		            data: 'id='+id+'&state='+state,
		            success: function (data) {
		            },
		            error: function(errors){
		                $('.before').hide();
		                $('.errors_form').html('');
		                $('.errors_form').html(errors);
		            }
		        });
        	}
	    }).disableSelection();
  	});
</script>