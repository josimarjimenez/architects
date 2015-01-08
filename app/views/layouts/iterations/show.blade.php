<ul id="messages">
     <li id="message_1"><a onclick="$('#message_1').fadeOut(); return false;" href="#"><small>Limpiar</small></a>{{ $message }}</li>
</ul>
<div class="project-body-header">
	<span class="iteration-board-link">
		<a href="/projects/project/k-gestion/iteration/117871/board">
			<i class="icon-th"></i>Pizarra scrum
		</a>
	</span>
	<h1 id="tour-iteration-name">
		{{ $iteration->name }} 
		<span class="iteration-title-date">
			{{ $iteration->start }} - {{ $iteration->end }}
		</span>
	</h1>
	<div id="iteration_stats" class="project-body-header-stats">
		<div class="stats-bubble">
			Historias
			<h4>0</h4> 
		</div>
		<div class="stats-bubble">
			Total Puntos
			<h4>0</h4> 
		</div>
		<div class="stats-bubble">
			Puntos en progreso
			<h4>0</h4> 
		</div>
		<div class="stats-bubble">
			Puntos completados
			<h4>0</h4> 
		</div>	
		<div class="stats-bubble">
			Dias restantes
			<h4>2</h4> 
		</div>
	</div>
	<div style="" id="burnup_chart">
		<div style="" id="iterationBurndown" class="noData">
			No hay suficientes datos
		</div>
		<br>
		<img src="https://d11uy15xvlvge3.cloudfront.net/static/v105/scrumdo/images/burndown.png">
	</div>	
</div>
<div class="container wide_body" id="body">
	<div style="margin-left:auto; margin-right:auto; width:100%;">
		<div id="story_form" class="story_form" style="margin-left:auto; margin-right:auto">
			<ul id="createdStories">
    		</ul>
    		<div id="addStoryFormOnProgress" class="hidden">Guardando historia.  Por favor espere...</div>
    		<form method="POST" id="addStoryForm">
    			<textarea id="id_summary" rows="1" cols="50" name="summary" maxlength="5000"></textarea>
    			 <button id="add_button" type="submit" class="btn">Agregar historia</button>
    		</form>
    	</div>
    	<img src="https://d11uy15xvlvge3.cloudfront.net/static/v105/scrumdo/images/ajax-loader.gif" id="loadingIcon">
    	<h1>Historia</h1>
    	<div class="iteration-app">
    		
    	</div>
    </div>
</div>