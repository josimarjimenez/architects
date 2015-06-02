<?php 

class GraphicsController extends BaseController{

 
 	public function index() {
 		 
 	}

    public function iterationSummary($id){
        JpGraph\JpGraph::load();
        JpGraph\JpGraph::module('bar');
        
        $datay=array(12,26,9,17,31);

        // Create the graph. 
        // One minute timeout for the cached image
        // INLINE_NO means don't stream it back to the browser.
        $graph = new Graph(310,250,'auto');
        $graph->SetScale("textlin");
        $graph->img->SetMargin(60,30,20,40);
        $graph->yaxis->SetTitleMargin(45);
        $graph->yaxis->scale->SetGrace(30);
        $graph->SetShadow();

        // Turn the tickmarks
        $graph->xaxis->SetTickSide(SIDE_DOWN);
        $graph->yaxis->SetTickSide(SIDE_LEFT);

        // Create a bar pot
        $bplot = new BarPlot($datay);

        // Create targets for the image maps. One for each column
        $targ=array("bar_clsmex1.php#1","bar_clsmex1.php#2","bar_clsmex1.php#3","bar_clsmex1.php#4","bar_clsmex1.php#5","bar_clsmex1.php#6");
        $alts=array("val=%d","val=%d","val=%d","val=%d","val=%d","val=%d");
        $bplot->SetCSIMTargets($targ,$alts);
        $bplot->SetFillColor("orange");

        // Use a shadow on the bar graphs (just use the default settings)
        $bplot->SetShadow();
        $bplot->value->SetFormat(" $ %2.1f",70);
        $bplot->value->SetFont(FF_ARIAL,FS_NORMAL,9);
        $bplot->value->SetColor("blue");
        $bplot->value->Show();

        $graph->Add($bplot);

        $graph->title->Set("Image maps barex1");
        $graph->xaxis->title->Set("X-title");
        $graph->yaxis->title->Set("Y-title");

        $graph->title->SetFont(FF_FONT1,FS_BOLD);
        $graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
        $graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

        // Send back the HTML page which will call this script again
        // to retrieve the image.
        $graph->StrokeCSIM();

    }

    /**
    *
    */
    public function iterationSummaryAux($id){   
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
		//$datax=array('TO-DO','DOING','DONE');
        $datax=array('POR HACER','HACIENDO','HECHAS');
		//Create the graph
		$graph = new Graph(900,400);    
		$graph->SetScale('textlin');
 
		$graph->img->SetMargin(60,130,40,60);
		$graph->SetShadow();

 		// Create the linear error plot
		$l1plot=new BarPlot($l1datay);
		$l1plot->SetColor('red');
		$l1plot->SetWeight(2);
		$l1plot->SetLegend('Avance de iteracion');
 
		// Add the plots to t'he graph 
		$graph->Add($l1plot);
        $graph->xaxis->SetTickLabels($datax); 

		$graph->title->Set('Tareas');
		//$graph->xaxis->title->Set('Estados');
		//$graph->yaxis->title->Set('Cantidad');

        
		$graph->title->SetFont(FF_FONT1,FS_BOLD);
		$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
		$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);


    
		//Display the graph
		$graph->Stroke();
	}


 public function iterationSummary2($id){   
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
         
    }
}
?>