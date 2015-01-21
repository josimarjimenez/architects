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
							<ul data-task-status="1" id="todo" class="task-popup-list ui-sortable" style="height: 155px;">
							</ul>
						</td> 	
						<td>
							<ul data-task-status="4" id="haciendo"  class="task-popup-list" style="height: 155px;">
							</ul>
						</td>	 	
						<td>
							<ul data-task-status="10"  id="hecho" class="task-popup-list" >
							</ul>
						</td>	 
					</tr>
				</tbody>
			</table>
	</div>
	<div class="modal-footer">
        <a class="btn btn-success new-task-button" href="#taskForm" onclick="mostrarTaskForm()">Nueva Tarea</a>        
        <a class="btn" data-dismiss="modal" href="#">Cerrar</a>        
	</div>
</div>