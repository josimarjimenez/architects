<?php 

//require_once ('app/libraries/jpgraph/docs/src/jpgraph.php');
//require_once ('app/libraries/jpgraph/docs/src/jpgraph_line.php');
//require_once ('app/libraries/jpgraph/docs/src/jpgraph_scatter.php');

class GraphicsIterationController extends BaseController{

 
    public function index() {
         
    }

    public function bar_time($id){

        $iterationAux;
        $project = Project::findOrFail($id);
        $iterations = Iterations::where('projectid', '=', $id)->get();

        $dataEstimatedTime = array();
        $dataRealTime = array();
        $dataIterationName = array();

        foreach ($iterations as $var) {
           $dataEstimatedTime[] = $var->estimatedTime;
           $dataRealTime[] = $var->realTime;
           $dataIterationName[] = $var->name;
        }

        //$string_iterations = implode(";", $iterations);

        JpGraph\JpGraph::load();
        JpGraph\JpGraph::module('bar');
        JpGraph\JpGraph::module('line');

        $data1y=array(45,40,95,25,50,25);
        $data2y=array(40,10,55,30,60,20);
         
        $graph = new Graph(800,400);    
        /*
        $graph->SetScale("textlin");
        $graph->SetShadow();
        $graph->img->SetMargin(40,30,20,40);
        */
        $graph->SetScale("textlin");
        $graph->SetShadow();
        $graph->img->SetMargin(40,30,40,40);
        //$graph->xaxis->SetTickLabels($gDateLocale->GetShortMonth());
         
        // Create the bar plots
        //$b1plot = new BarPlot($data1y);
        $b1plot = new BarPlot($dataEstimatedTime);
        $b1plot->SetFillColor("orange");
        //$b2plot = new BarPlot($data2y);
        $b2plot = new BarPlot($dataRealTime);
        $b2plot->SetFillColor("blue");
         
        // Create the grouped bar plot
        $gbplot = new GroupBarPlot(array($b1plot,$b2plot));
         
        // ...and add it to the graPH
        $graph->Add($gbplot);

        $b1plot->value->Show();
        //$b1plot->value->SetColor("#A519B5");
        $b1plot->value->SetColor("orange");
        $b1plot->SetLegend('Tiempo estimado');

        $b2plot->SetColor("#47CE7D");
        $b2plot->SetFillColor("#47CE7D");
        $b2plot->value->Show();
        $b2plot->value->SetColor("#A519B5");
        //$b2plot->value->SetColor("orange");
        $b2plot->SetLegend('Tiempo real');
         
        $graph->title->Set('GRAFICO DE BARRAS');
        $graph->subtitle->Set('(Tiempo)');
      
       // $graph->xaxis->title->Set("X-title");
       // $graph->yaxis->title->Set("Y-title");
         
        $graph->title->SetFont(FF_FONT1,FS_BOLD);
        $graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
        $graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
        $graph->xaxis->SetTickLabels($dataIterationName); 
        // Display the graph

        $graph->legend->SetFrameWeight(2);
        $graph->legend->SetFont(FF_FONT1,FS_BOLD);


        // Display the graph
        $graph->Stroke();

    }

    public function bar_budget($id){

        $iterationAux;
        $project = Project::findOrFail($id);
        $iterations = Iterations::where('projectid', '=', $id)->get();

        $string_iterations;
        
        $dataBudgetEstimated = array();
        $dataBudgetReal = array();
        $dataIterationName = array();

        foreach ($iterations as $var) {
           $dataBudgetEstimated[] = $var->estimatedBudget;
           $dataBudgetReal[] = $var->realBudget;
           $dataIterationName[] = $var->name;
        }

        //$string_iterations = implode(";", $iterations);

        JpGraph\JpGraph::load();
        JpGraph\JpGraph::module('bar');
        JpGraph\JpGraph::module('line');

        $data1y=array(45,40,95,25,50,25);
        $data2y=array(40,10,55,30,60,20);
         
        $graph = new Graph(800,400);    
        /*
        $graph->SetScale("textlin");
        $graph->SetShadow();
        $graph->img->SetMargin(40,30,20,40);
        */
        $graph->SetScale("textlin");
        $graph->SetShadow();
        $graph->img->SetMargin(40,50,40,40);
        //$graph->xaxis->SetTickLabels($gDateLocale->GetShortMonth());
         
        // Create the bar plots
        //$b1plot = new BarPlot($data1y);
        $b1plot = new BarPlot($dataBudgetEstimated);
        $b1plot->SetFillColor("orange");
        //$b2plot = new BarPlot($data2y);
        $b2plot = new BarPlot($dataBudgetReal);
        $b2plot->SetFillColor("blue");
         
        // Create the grouped bar plot
        $gbplot = new GroupBarPlot(array($b1plot,$b2plot));

        // ...and add it to the graPH
        $graph->Add($gbplot);

        $b1plot->value->Show();
        //$b1plot->value->SetColor("#A519B5");
        $b1plot->value->SetColor("orange");
        $b1plot->SetLegend('Presupuesto estimado');

        $b2plot->SetColor("#47CE7D");
        $b2plot->SetFillColor("#47CE7D");
        $b2plot->value->Show();
        $b2plot->value->SetColor("#A519B5");
        $b2plot->SetLegend('Presupuesto real');
        
        $graph->title->Set('GRAFICO BARRAS');
        $graph->subtitle->Set('(Presupuesto)');

        $graph->title->SetFont(FF_FONT1,FS_BOLD);
        $graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
        $graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
        $graph->xaxis->SetTickLabels($dataIterationName); 
        // Display the graph

        $graph->legend->SetFrameWeight(2);
        $graph->legend->SetFont(FF_FONT1,FS_BOLD);

        $graph->Stroke();

    }


    public function line_time($id){

        $iterationAux;
        $project = Project::findOrFail($id);
        $iterations = Iterations::where('projectid', '=', $id)->get();

        $dataEstimatedTime = array();
        $dataRealTime = array();
        $dataIterationName = array();

        $dataEstimatedTime[] = 0;
        $dataRealTime[] = 0;
        $dataIterationName[] = '';

        foreach ($iterations as $var) {
           $dataEstimatedTime[] = $var->estimatedTime;
           $dataRealTime[] = $var->realTime;
           $dataIterationName[] = $var->name;
        }

        //$string_iterations = implode(";", $iterations);

        JpGraph\JpGraph::load();
        JpGraph\JpGraph::module('bar');
        JpGraph\JpGraph::module('line');
        
        // Some (random) data
        $ydata   = array(0,11, 3, 8, 12, 5, 1, 9, 13, 5, 7);
        $ydata2  = array(0,1, 19, 15, 7, 22, 14, 5, 9, 21, 13 );
         
        // Size of the overall graph
        $width=800;
        $height=400;
         
        // Create the graph and set a scale.
        // These two calls are always required
        $graph = new Graph($width,$height);
        $graph->SetScale('intlin');
        $graph->SetShadow();
         
        // Setup margin and titles
        //$graph->img->SetMargin(40,30,40,40);
        $graph->SetMargin(40,50,40,40);
        $graph->title->Set('GRAFICO LINEAL');
        $graph->subtitle->Set('(Tiempo)');

        $graph->title->SetFont(FF_FONT1,FS_BOLD);
        //$graph->xaxis->title->Set('Operator');
        //$graph->yaxis->title->Set('# of calls');
         
        $graph->yaxis->title->SetFont( FF_FONT1 , FS_BOLD );
        $graph->xaxis->title->SetFont( FF_FONT1 , FS_BOLD ); 

        $graph->xaxis->SetTickLabels($dataIterationName);

        // Create the first data series
        $lineplot=new LinePlot($dataEstimatedTime);
        $lineplot->SetWeight( 2 );   // Two pixel wide
        
        $lineplot->mark->SetType(MARK_SQUARE );
        $lineplot->mark->SetWidth(7);
        $lineplot->mark->SetColor('orange');
        //$lineplot->mark->SetColor('#A519B5');
        $lineplot->mark->SetFillColor('orange');
        //$lineplot->mark->SetFillColor('#A519B5');
         
        


        // Add the plot to the graph
        $graph->Add($lineplot);
        $lineplot->value->Show();
        //$lineplot->value->SetColor("#A519B5");   
        $lineplot->value->SetColor("orange");

        $lineplot->SetLegend('Tiempo estimado');

        // Create the second data series
        $lineplot2=new LinePlot($dataRealTime);
        
         
        /*
            MARK_SQUARE, A filled square
            MARK_UTRIANGLE, A triangle pointed upwards
            MARK_DTRIANGLE, A triangle pointed downwards
            MARK_DIAMOND, A diamond
            MARK_CIRCLE, A circle
            MARK_FILLEDCIRCLE, A filled circle
            MARK_CROSS, A cross
            MARK_STAR, A star
            MARK_X, An 'X'
            MARK_LEFTTRIANGLE, A half triangle, vertical line to left (used as group markers for Gantt charts)
            MARK_RIGHTTRIANGLE, A half triangle, vertical line to right (used as group markers for Gantt charts)
            MARK_FLASH, A Zig-Z
        */

        //$lineplot2->SetWeight( 2 );   // Two pixel wide
        //$lineplot2->mark->SetType(MARK_DIAMOND);
        //$lineplot2->mark->SetColor('#A519B5');
        //$lineplot2->mark->SetFillColor('#A519B5');

        $lineplot2->mark->SetType(MARK_DIAMOND);
        $lineplot2->mark->SetWidth(10);
        $lineplot2->mark->SetColor('#A519B5');
        //$lineplot2->mark->SetColor('orange');
        $lineplot2->mark->SetFillColor('#A519B5');
        //$lineplot2->mark->SetFillColor('orange');

        // Add the second plot to the graph
        $graph->Add($lineplot2);
        $lineplot2->SetColor("#00D053");
        $lineplot2->SetLegend('Timepo real');

        $lineplot2->value->Show();
//        $lineplot2->value->SetColor("orange"); 
        $lineplot2->value->SetColor("#A519B5");   
        
        $graph->legend->SetFrameWeight(2);
        $graph->legend->SetFont(FF_FONT1,FS_BOLD);


        // Display the graph
        $graph->Stroke();
    }


    public function line_budget($id){

        $iterationAux;
        $project = Project::findOrFail($id);
        $iterations = Iterations::where('projectid', '=', $id)->get();

        $string_iterations;
        
        $dataBudgetEstimated = array();
        $dataBudgetReal = array();
        $dataIterationName = array();

        $dataBudgetEstimated[] = 0;
        $dataBudgetReal[] = 0;
        $dataIterationName[] = '';

        foreach ($iterations as $var) {
           $dataBudgetEstimated[] = $var->estimatedBudget;
           $dataBudgetReal[] = $var->realBudget;
           $dataIterationName[] = $var->name;
        }

        //$string_iterations = implode(";", $iterations);

        JpGraph\JpGraph::load();
        JpGraph\JpGraph::module('bar');
        JpGraph\JpGraph::module('line');
        
        // Some (random) data
        $ydata   = array(0,11, 3, 8, 12, 5, 1, 9, 13, 5, 7);
        $ydata2  = array(0,1, 19, 15, 7, 22, 14, 5, 9, 21, 13 );
         
        // Size of the overall graph
        $width=800;
        $height=400;
         
        // Create the graph and set a scale.
        // These two calls are always required
        $graph = new Graph($width,$height);
        $graph->SetScale('intlin');
        $graph->SetShadow();
         
        // Setup margin and titles
        //$graph->img->SetMargin(40,30,40,40);
        $graph->SetMargin(40,50,40,40);
        $graph->title->Set('GRAFICO LINEAL');
        $graph->subtitle->Set('(Presupuesto)');

        $graph->title->SetFont(FF_FONT1,FS_BOLD);
        //$graph->xaxis->title->Set('Operator');
        //$graph->yaxis->title->Set('# of calls');
         
        $graph->yaxis->title->SetFont( FF_FONT1 , FS_BOLD );
        $graph->xaxis->title->SetFont( FF_FONT1 , FS_BOLD ); 

        $graph->xaxis->SetTickLabels($dataIterationName);

        // Create the first data series
        $lineplot=new LinePlot($dataBudgetEstimated);
        $lineplot->SetWeight( 2 );   // Two pixel wide
        
        $lineplot->mark->SetType(MARK_SQUARE );
        $lineplot->mark->SetWidth(7);
        $lineplot->mark->SetColor('orange');
        //$lineplot->mark->SetColor('#A519B5');
        $lineplot->mark->SetFillColor('orange');
        //$lineplot->mark->SetFillColor('#A519B5');
         
        


        // Add the plot to the graph
        $graph->Add($lineplot);
        $lineplot->value->Show();
        //$lineplot->value->SetColor("#A519B5");   
        $lineplot->value->SetColor("orange");

        $lineplot->SetLegend('Presupuesto estimado');

        // Create the second data series
        $lineplot2=new LinePlot($dataBudgetReal);
        
         
        /*
            MARK_SQUARE, A filled square
            MARK_UTRIANGLE, A triangle pointed upwards
            MARK_DTRIANGLE, A triangle pointed downwards
            MARK_DIAMOND, A diamond
            MARK_CIRCLE, A circle
            MARK_FILLEDCIRCLE, A filled circle
            MARK_CROSS, A cross
            MARK_STAR, A star
            MARK_X, An 'X'
            MARK_LEFTTRIANGLE, A half triangle, vertical line to left (used as group markers for Gantt charts)
            MARK_RIGHTTRIANGLE, A half triangle, vertical line to right (used as group markers for Gantt charts)
            MARK_FLASH, A Zig-Z
        */

        //$lineplot2->SetWeight( 2 );   // Two pixel wide
        //$lineplot2->mark->SetType(MARK_DIAMOND);
        //$lineplot2->mark->SetColor('#A519B5');
        //$lineplot2->mark->SetFillColor('#A519B5');

        $lineplot2->mark->SetType(MARK_DIAMOND);
        $lineplot2->mark->SetWidth(10);
        $lineplot2->mark->SetColor('#A519B5');
        //$lineplot2->mark->SetColor('orange');
        $lineplot2->mark->SetFillColor('#A519B5');
        //$lineplot2->mark->SetFillColor('orange');

        // Add the second plot to the graph
        $graph->Add($lineplot2);
        $lineplot2->SetColor("#00D053");
        $lineplot2->SetLegend('Presupuesto real');

        $lineplot2->value->Show();
//        $lineplot2->value->SetColor("orange"); 
        $lineplot2->value->SetColor("#A519B5");   
        
        $graph->legend->SetFrameWeight(2);
        $graph->legend->SetFont(FF_FONT1,FS_BOLD);


        // Display the graph
        $graph->Stroke();
    }

    public function bar_task($id){

        $help = new Helper();
        $issues = $help->searchIssues($id);

       // $issuesTmp = Issue::where('iterationid','=', $id)->get();  

        //foreach ($issues as $issue) {
            # code...
        //  $issue->id
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
         
        // Display the graph
        $graph->Stroke();

    }

}
?>