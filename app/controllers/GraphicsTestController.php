<?php 

//require_once ('app/libraries/jpgraph/docs/src/jpgraph.php');
//require_once ('app/libraries/jpgraph/docs/src/jpgraph_line.php');
//require_once ('app/libraries/jpgraph/docs/src/jpgraph_scatter.php');

class GraphicsTestController extends BaseController{

 
    public function index() {
         
    }

    /**
    *
    */
    public function summary($id){  

        JpGraph\JpGraph::load();
        JpGraph\JpGraph::module('line');


        $datay1 = array(33,20,24,5,38,24,22);
        $datay2 = array(9,7,10,25,10,8,4);
        $datay3 = array(20,13,7,2,35,16,25);

        // Setup the graph
        $graph = new Graph(500,300);

        $graph->SetScale("textlin",0,50);

        $theme_class= new UniversalTheme;
        $graph->SetTheme($theme_class);

        $graph->title->Set("Line Plots with Markers");

        $graph->SetBox(false);
        $graph->ygrid->SetFill(false);
        $graph->yaxis->HideLine(false);
        $graph->yaxis->HideTicks(false,false);
        $graph->yaxis->HideZeroLabel();

        $graph->xaxis->SetTickLabels(array('A','B','C','D','E','F','G'));
        // Create the plot
        $p1 = new LinePlot($datay1);
        $graph->Add($p1);

        $p2 = new LinePlot($datay2);
        $graph->Add($p2);

        $p3 = new LinePlot($datay3);
        $graph->Add($p3);


        // Use an image of favourite car as marker
        //$p1->mark->SetType(MARK_IMG,'new1.gif',0.8);
        $p1->SetColor('#aadddd');
        $p1->value->SetFormat('%d');
        $p1->value->Show();
        $p1->value->SetColor('#55bbdd');

        //$p2->mark->SetType(MARK_IMG,'new2.gif',0.8);
        $p2->SetColor('#ddaa99');
        $p2->value->SetFormat('%d');
        $p2->value->Show();
        $p2->value->SetColor('#55bbdd');

         // Standard Y-axis plot
        $p3->SetLegend('2001');
        //$p3->mark->SetType(MARK_DIAMOND);
        //$p3->mark->SetFillColor('orange');

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
    MARK_FLASH, A Zig-Zag vertical flash 
*/
        $p3->mark->SetType(MARK_DIAMOND);
        $p3->mark->SetFillColor('green');
        $p3->mark->SetWidth(15);
        $p3->value->SetFormat('%d');
        $p3->value->Show();
        $p3->value->SetColor('#55bbdd');
        //$p3->SetCSIMTargets($targ1,$alts1);
        $graph->yaxis->title->Set('Basic Rate');
        $graph->yaxis->title->SetColor('black');

        $graph->Stroke();
            /*
            $datay1 = array(20,15,23,15);
            $datay2 = array(12,9,42,8);
            $datay3 = array(5,17,32,24);

            // Setup the graph
            $graph = new Graph(300,250);
            $graph->SetScale("textlin");

            $theme_class=new UniversalTheme;

            $graph->SetTheme($theme_class);
            $graph->img->SetAntiAliasing(false);
            $graph->title->Set('Filled Y-grid');
            $graph->SetBox(false);

            $graph->img->SetAntiAliasing();

            $graph->yaxis->HideZeroLabel();
            $graph->yaxis->HideLine(false);
            $graph->yaxis->HideTicks(false,false);

            $graph->xgrid->Show();
            $graph->xgrid->SetLineStyle("solid");
            $graph->xaxis->SetTickLabels(array('A','B','C','D'));
            $graph->xgrid->SetColor('#E3E3E3');

            // Create the first line
            $p1 = new LinePlot($datay1);
            $graph->Add($p1);
            $p1->SetColor("#6495ED");
            $p1->SetLegend('Line 1');

            // Create the second line
            $p2 = new LinePlot($datay2);
            $graph->Add($p2);
            $p2->SetColor("#B22222");
            $p2->SetLegend('Line 2');

            // Create the third line
            $p3 = new LinePlot($datay3);
            $graph->Add($p3);
            $p3->SetColor("#FF1493");
            $p3->SetLegend('Line 3');

            $graph->legend->SetFrameWeight(1);

            // Output line
            $graph->Stroke();
    */
    }
}
?>