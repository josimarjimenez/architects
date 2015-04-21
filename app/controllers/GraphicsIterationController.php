<?php 

//require_once ('app/libraries/jpgraph/docs/src/jpgraph.php');
//require_once ('app/libraries/jpgraph/docs/src/jpgraph_line.php');
//require_once ('app/libraries/jpgraph/docs/src/jpgraph_scatter.php');

class GraphicsIterationController extends BaseController{

 
    public function index() {
         
    }

    /**
    *
    */
    //public function summary($id){  
    public function summary_aux($id){  

            
        $iterationAux;

        //try {
        $project = Project::findOrFail($id);
        $iterations = Iterations::where('projectid', '=', $id)->get();
            
            //foreach($iterations as $var){
              //  $iterationAux = $iterationAux . var_dump($var);
            //}
        //}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) { 
        //}
        //die;


        JpGraph\JpGraph::load();
        JpGraph\JpGraph::module('bar');
        JpGraph\JpGraph::module('line');

       
        $data1y=array(0,0,0,0);
        $data2y=array(61,30,82,105);
        $data3y=array(115,50,70,93);


        // Create the graph. These two calls are always required
        $graph = new Graph(450,200,'auto');
        $graph->SetScale("textlin");

        $theme_class=new UniversalTheme;
        $graph->SetTheme($theme_class);

        $graph->yaxis->SetTickPositions(array(0,30,60,90,120,150), array(15,45,75,105,135));
        $graph->SetBox(false);

        $graph->ygrid->SetFill(false);
        $graph->xaxis->SetTickLabels(array('A','B','C','D'));
        $graph->yaxis->HideLine(false);
        $graph->yaxis->HideTicks(false,false);

        // Create the bar plots
        $b1plot = new BarPlot($data1y);
        $b2plot = new BarPlot($data2y);
        $b3plot = new BarPlot($data3y);

        // Create the grouped bar plot
        $gbplot = new GroupBarPlot(array($b1plot,$b2plot,$b3plot));
        // ...and add it to the graPH
        $graph->Add($gbplot);


        $b1plot->SetColor("white");
        $b1plot->SetFillColor("#cc1111");

        $b2plot->SetColor("white");
        $b2plot->SetFillColor("#11cccc");

        $b3plot->SetColor("white");
        $b3plot->SetFillColor("#1111cc");

        $graph->title->Set("Bar Plots");

        // Display the graph
        $graph->Stroke();
    }

    public function bar_time($id){

        $iterationAux;
        $project = Project::findOrFail($id);
        $iterations = Iterations::where('projectid', '=', $id)->get();

        $dataEstimatedTime = array();
        $dataRealTime = array();

        foreach ($iterations as $var) {
           $dataEstimatedTime[] = $var->estimatedTime;
           $dataRealTime[] = $var->realTime;
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
         
        $graph->title->Set("Example 21 " . ' ' . implode(";", $dataEstimatedTime) . ' - ' . implode(";", $dataRealTime));
        $graph->xaxis->title->Set("X-title");
        $graph->yaxis->title->Set("Y-title");
         
        $graph->title->SetFont(FF_FONT1,FS_BOLD);
        $graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
        $graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
         
        // Display the graph
        $graph->Stroke();

    }

    public function bar_budget($id){

        $iterationAux;
        $project = Project::findOrFail($id);
        $iterations = Iterations::where('projectid', '=', $id)->get();

        $string_iterations;
        
        $dataBudgetEstimated = array();
        $dataBudgetReal = array();$dataIterationName = array();
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
        $b1plot->value->SetColor("#A519B5");
        $b1plot->SetLegend('Tiempo estimado');

        $b2plot->SetColor("#47CE7D");
        $b2plot->SetFillColor("#47CE7D");
        $b2plot->value->Show();
        $b2plot->value->SetColor("#A519B5");
        $b2plot->SetLegend('Tiempo real');
        
        $graph->title->Set("Example 21 " . ' ' . implode(";", $dataBudgetEstimated) . ' - ' . implode(";", $dataBudgetReal));
       // $graph->xaxis->title->Set("X-title");
       // $graph->yaxis->title->Set("Y-title");
         
        $graph->title->SetFont(FF_FONT1,FS_BOLD);
        $graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
        $graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
        $graph->xaxis->SetTickLabels($dataIterationName); 
        // Display the graph

        $graph->legend->SetFrameWeight(2);
        $graph->legend->SetFont(FF_FONT1,FS_BOLD);

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
        $height=500;
         
        // Create the graph and set a scale.
        // These two calls are always required
        $graph = new Graph($width,$height);
        $graph->SetScale('intlin');
        $graph->SetShadow();
         
        // Setup margin and titles
        //$graph->img->SetMargin(40,30,40,40);
        $graph->SetMargin(40,50,40,40);
        $graph->title->Set('Calls per operator (June,July)');
        $graph->subtitle->Set('(March 12, 2008)');
        //$graph->xaxis->title->Set('Operator');
        //$graph->yaxis->title->Set('# of calls');
         
        $graph->yaxis->title->SetFont( FF_FONT1 , FS_BOLD );
        $graph->xaxis->title->SetFont( FF_FONT1 , FS_BOLD ); 

        $graph->xaxis->SetTickLabels($dataIterationName);

        // Create the first data series
        $lineplot=new LinePlot($dataBudgetEstimated);
        $lineplot->SetWeight( 2 );   // Two pixel wide
        
        $lineplot->mark->SetType(MARK_FILLEDCIRCLE);
        $lineplot->mark->SetColor('#A519B5');
        $lineplot->mark->SetFillColor('#A519B5');
         
        


        // Add the plot to the graph
        $graph->Add($lineplot);
        $lineplot->value->Show();
        $lineplot->value->SetColor("#A519B5");   

        $lineplot->SetLegend('Tiempo estimado');

        // Create the second data series
        $lineplot2=new LinePlot($dataBudgetReal);
        $lineplot2->SetWeight( 2 );   // Two pixel wide
         
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

        $lineplot2->mark->SetType(MARK_FILLEDCIRCLE);
        $lineplot2->mark->SetColor('#A519B5');
        $lineplot2->mark->SetFillColor('#A519B5');

        // Add the second plot to the graph
        $graph->Add($lineplot2);
        $lineplot2->SetColor("#00D053");
        $lineplot2->SetLegend('Tiempo real');

        $lineplot2->value->Show();
        $lineplot2->value->SetColor("#A519B5");  
        
        $graph->legend->SetFrameWeight(2);
        $graph->legend->SetFont(FF_FONT1,FS_BOLD);


        // Display the graph
        $graph->Stroke();
    }

}
?>