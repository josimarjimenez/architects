<?php 

class GraphicsController extends BaseController{

 
 	public function index() {
 		 
 	}

    /**
    *
    */
    public function iterationSummary($id){  
 
    	$iteration = Iterations::findOrFail($id);

    	$issues = Issue::where('iterationid','=',$iteration->id)->get();

    	$tasksId=array();
    	foreach ($issues as $issue) { 
    		$tasksId[] = $issue->id;
    	}
    	  

    	$tasks =  Task::whereIn('issueid',$tasksId)->get();

    	$countTODO = 0;
    	$countDOING =0; 
    	$countDONE = 0;
 
    	foreach ($tasks as $task) { 
    		switch ($task->scrumid) {
    			case 1: 
    				$countTODO++;
    				break;
    			case 2: 
    				$countDOING++;
    				break;
    			case 3: 
    				$countDONE++;
    				break; 
    		} 
    	}

        
    	
    	JpGraph\JpGraph::load();
    	JpGraph\JpGraph::module('bar');

		$l1datay = array($countTODO,$countDOING, $countDONE);
		$datax=array('TO-DO','DOING','DONE');
		//Create the graph
		$graph = new Graph(900,400);    
		$graph->SetScale('textlin');
 
		$graph->img->SetMargin(40,130,20,40);
		$graph->SetShadow();
 
		// Create the linear error plot
		$l1plot=new BarPlot($l1datay);
		$l1plot->SetColor('red');
		$l1plot->SetWeight(2);
		$l1plot->SetLegend('Avance de iteración');
 
		
		// Add the plots to t'he graph 
		$graph->Add($l1plot);
 
		$graph->title->Set('Tareas');
		$graph->xaxis->title->Set('Estados');
		$graph->yaxis->title->Set('Cantidad');
 
		$graph->title->SetFont(FF_FONT1,FS_BOLD);
		$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
		$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
 
		$graph->xaxis->SetTickLabels($datax); 
		
		//Display the graph
		$graph->Stroke();

	}
}
?>