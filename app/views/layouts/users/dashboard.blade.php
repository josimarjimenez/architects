
  <h1 id="tour-org-name">{{ $organization->name }}</h1>
  <div id="report">
    <div class="report-tab-holder">
      <div class="report-tab">
        <a href="#" id="yourstats">Tus estadísticas</a>
      </div>
      <div class="report-tab report-tab report-tab-selected">
        <a href="#" id="summary">Estadísticas de la organización</a></div>
      </div>

    <div id="report_areaTE" style="min-height: 92px; text-align:center">

      <div class="stats-bubble">
        Tus puntos
        <h4>0</h4> 
      </div>

      <div class="stats-bubble">
        Tus proyectos
        <h4>0</h4> 
      </div>

      <div class="stats-bubble">
        Tus tareas completadas
        <h4>0</h4> 
      </div> 
    </div>

    <div id="report_areaEO" style="min-height: 92px; text-align:center">
      <div class="stats-bubble">
        Proyectos
        <h4>{{ $projectsCount }}</h4> 
      </div>

      <div class="stats-bubble">
        Total de historias
        <h4>{{ $iterationsCount }}</h4> 
      </div>

      <div class="stats-bubble">
        Total tareas
        <h4>{{ $taskCount }}</h4> 
      </div> 
    </div>
</div>

<div class="my-dashboard-holder">
	<div class="mydashboard">
		<ul class="dash-project-list">
			@foreach ($organization->projects as $project)
     <li class="dash-project">
      <div class="dash-proj-title">
       {{ $project->name }}
       <span class="right-aligned-links">
        <a href="/projects/{{$project->id}}"><i data-original-title="resumen proyecto" class="icon-globe tooltip-enabled" title=""></i></a>
      </span>
    </div>
    <ul class="dash-iteration-list">
      @foreach ($project->iterations as $iteration)
      <li>
        <div class="dash-iter-title">
         <b class="dash-iter-name">{{ $iteration->name }}</b>
         <i class="dash-iter-dates">{{ $iteration->start }} - {{  $iteration->end }}</i>
         <span class="right-aligned-links">
           <a href="/iterations/{{ $iteration->id }}" title="" class="tooltip-enabled" data-original-title="lista de historias"><i class="icon-glyph icon-reorder"></i></a>
           <a href="/iterations/{{ $iteration->id }}/board" title="" class="tooltip-enabled" data-original-title="Scrum Board">
            <i class="icon-glyph icon-th"></i></a>
         </span>
       </div>
       <table class="dash-iter-table">
         <tbody>
          <tr>
           <td class="dash-iter-left">
            {{ HTML::image('images/sprint1.png', 'class="img-responsive"') }}
          </td>
          <td class="dash-iter-right">
            <span class="recent-stories" style="display: inline;">Modificados recientemente:</span>
            <ul class="dash-iter-stories">
             @foreach ($iteration->issues as $issue)
             <li class="story-view story-style-list superboard-story story_block gripper-status-4" >
               <div class="story-checkbox-holder" style="display: none;">
                <input type="checkbox" class="story-checkbox">
              </div>
              <span 
              class="story-icons">
              <a href="#" class="edit-story-button">
                <i class="icon-glyph icon-edit" title="Editar historia"></i>
              </a>        
            </span>
            <h1 class="formatted_story_text">
              <span style="color:#555555;" class="story_number">
               #3
             </span>
             <p>{{ $issue->summary }}
             </p>
           </h1>
         </li>
         @endforeach 
       </ul>
     </td>
   </tr>
 </tbody>
</table>
</li>	
@endforeach 
</ul>
</li> 
@endforeach 
</ul>
</div>
</div>
<br>
<script type="text/javascript">
  $( document ).ready(function(){

    $("#report_areaTE").css( "display", "none" );
    $("#report_areaEO").css( "display", "block" );

    $("#yourstats").click(function() { 
      $(this).parent().addClass( "report-tab-selected" );
      $("#summary").parent().removeClass( "report-tab-selected" );
      $("#report_areaTE").css( "display", "block" );
      $("#report_areaEO").css( "display", "none" );
    });

    $("#summary").click(function() { 
      $(this).parent().addClass( "report-tab-selected" );
      $("#yourstats").parent().removeClass( "report-tab-selected" );
      $("#report_areaTE").css( "display", "none" );
      $("#report_areaEO").css( "display", "block" );
    });
});


</script>