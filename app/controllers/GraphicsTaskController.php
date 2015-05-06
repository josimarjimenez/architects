<?php 

//require_once ('app/libraries/jpgraph/docs/src/jpgraph.php');
//require_once ('app/libraries/jpgraph/docs/src/jpgraph_line.php');
//require_once ('app/libraries/jpgraph/docs/src/jpgraph_scatter.php');

class GraphicsTaskController extends BaseController{


    public function bar_task($id){

    	$help = new Helper();
        $issues = $help->searchIssues($id);


    	//foreach ($issues as $issue) {
    		# code...
    	//	$issue->id
    	//}

        //$iteration = Iterations::findOrFail($id);
        //$idTmp = $iteration->id;
       // $issues = Issue::where('iterationid','=', $idTmp)->get();
       //$issues = $iteration->issues;    
        //$countIssues = sizeof($issues);
        $countIssues = 0;
        $dataEstimatedTime = array();
        $dataRealTime = array();
        $dataIterationName = array();

        $countTODO = 0;
    	$countDOING =0; 
    	$countDONE = 0;


        //$string_iterations = implode(";", $iterations);

        JpGraph\JpGraph::load();
        JpGraph\JpGraph::module('bar');
        JpGraph\JpGraph::module('line');

		$datay=array(12,8,19,3,10,5);
		 
		// Create the graph. These two calls are always required
		$graph = new Graph(300,200);
		$graph->SetScale('textlin');
		 
		// Add a drop shadow
		$graph->SetShadow();
		 
		// Adjust the margin a bit to make more room for titles
		$graph->SetMargin(40,30,20,40);
		 
		// Create a bar pot
		$bplot = new BarPlot($datay);
		 
		// Adjust fill color
		$bplot->SetFillColor('orange');
		$graph->Add($bplot);
		 
		// Setup the titles
		$graph->title->Set('A basic bar graph ');
		$graph->xaxis->title->Set('X-title');
		$graph->yaxis->title->Set('Y-title');
		 
		$graph->title->SetFont(FF_FONT1,FS_BOLD);
		$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
		$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
		 
		//$graph->Stroke();

		//$response = Response::make(
               //     $graph->Stroke()
    	//);

//    	$response->header('content-type', 'image/png');

  //  	return $response;

    }

}
?>