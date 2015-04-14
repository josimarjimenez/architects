<?php 
 

class GraphicsSpendingController extends BaseController{

 
    public function index() {
         
    }

    public function summary($id){  
    
        JpGraph\JpGraph::load();
        JpGraph\JpGraph::module('line');


         $targ1 = array();
         $targ2= array();
         $targ3 = array();
         $alts1 = array();
         $alts2 = array();
         $alts3 = array();

        // Setup some dummy targets for the CSIM
        $n = 5;
        for($i=0; $i < $n; ++$i ) {
            $targ1[$i] = "#$i";
            $targ2[$i] = "#$i";
            $targ3[$i] = "#$i";
            $alts1[$i] = "val=%d";
            $alts2[$i] = "val=%d";
            $alts3[$i] = "val=%d";
        }

        
        $datay1 = array(20,15,23,15,80,20,45,10,5,45,60);
        $datay2 = array(12,9,12,8,41,15,30,8,48,36,14,25,30,35);
        $datay3 = array(5,17,32,24,4,2,36,2,9,24,21,23);


        $dateStart = '2015-03-01';
        $dateEnd = '2016-04-30';

        $numberTotalDays = $this->numberDaysBetweenTwoDates($dateStart, $dateEnd);
        $numberTotalMonths = $this->numberMonthBetweenTwoDates($dateStart, $dateEnd);

        $yearStart = $this->obtainInfoDate($dateStart, "Y");
        $monthStart = $this->obtainInfoDate($dateStart, 'n');
        $dayStart = $this->obtainInfoDate($dateStart,'d');

        $yearEnd = $this->obtainInfoDate($dateEnd, "Y");
        $monthEnd = $this->obtainInfoDate($dateEnd, "n");
        $dayEnd = $this->obtainInfoDate($dateEnd, "d");

        $arrayDays = array();

        $result = array();
        $result[] = 0;
        $monthCount = $monthStart;
        $yearCount = $yearStart;
        $daysElapsed = 0;
        $percentaje = 0;
        $days = 0;
        $counter = 0;
        
        for ($i = 1; $i <= $numberTotalMonths; $i++) { 
            
            if($i == 1){
                $days = $this->numberDaysFirstMonth($yearCount, $monthCount, $dayStart);
                $arrayDays[] = $monthCount . '+' . $days;
                $daysElapsed = $daysElapsed + $days;
                $percentaje = $this->calculatePercentage($numberTotalDays, $daysElapsed);
                $result[] = $percentaje;

            } elseif ($i == $numberTotalMonths) {
                $days = $dayEnd;
                $arrayDays[] = $monthCount . '+' . $days;
                $daysElapsed = $daysElapsed + $days;
                $percentaje = $this->calculatePercentage($numberTotalDays, $daysElapsed);
                $result[] = $percentaje;
            }else {
                $days = $this->numberDaysPerMonth($yearCount, $monthCount);
                $arrayDays[] = $monthCount . '+' . $days;
                $daysElapsed = $daysElapsed + $days;
                $percentaje = $this->calculatePercentage($numberTotalDays, $daysElapsed);
                $result[] = $percentaje;
            }
            
            if($monthCount == 12){
                $monthCount = 0;
                $yearCount++;
            }

            $monthCount++;
        }
        
        $stringTmp = '';
        foreach ($arrayDays as $var) {
           $stringTmp = $stringTmp . (string) $var . ' - ';
        } 

        //$datay3 = $result;

        // Setup the graph
        $graph = new Graph(900,350);
        //$graph->SetScale("textlin");


        $graph->SetScale("intlin");
        //$graph->SetYScale(0,'int');
        //$graph->SetYScale(1,'int');

        $theme_class=new UniversalTheme;

        //$numberDays = $this->numberDaysBetweenTwoDates('2013-01-01','2014-01-01');

        //$numberMonth = $this->numberMonthBetweenTwoDates('2013-01-01','2013-12-20');

        //$month = $this->obtainInfoFromDate('2013-12-20');
        
        //$yearStart = $this->obtainInfoDate('2013-12-20', "Y");
        //$monthStart = $this->obtainInfoDate('2013-12-20', 'm');
        //$dayStart = $this->obtainInfoDate('2013-12-20','d');

        $graph->SetTheme($theme_class);
        $graph->img->SetAntiAliasing(false);


        //$numberTotalMonths = $this->numberMonthBetweenTwoDates($dateStart, $dateEnd);
        //$monthStart = $this->obtainInfoDate($dateStart, 'n');
        //$monthEnd = $this->obtainInfoDate($dateEnd, 'n');
        
        $monthNames = array('Ene','Feb','Mar','Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic');
       // $result = array();
        $counter = $monthStart - 1;
        $resultNames = array();
        $resultNames[] = '';
        for ($i=0; $i<$numberTotalMonths; $i++) { 
                $resultNames[] = $monthNames[$counter];
                $counter++;
                if($counter == 12){
                    $counter = 0;
                }
        }
        
        
        $graph->title->Set('Pedidos ' . $numberTotalMonths . ' , ' . $numberTotalDays . ' , ' . $daysElapsed . ' : ' . $stringTmp . ' ; ' . $monthStart);
//        $graph->title->Set('Evolución de pedidos ' . $numberTotalMonths . ' ' . $numberTotalDays . ' ' . $yearStart . ' ' . $monthStart . ' ' . $daysElapsed . ' ' . $percentaje . ' ' . $stringTmp);
        //$graph->title->Set('Evolución de pedidos ' . $numberTotalMonths);$arrayDays
        //$graph->title->Set('Evolución de pedidos');
        $graph->SetBox(false);

        $graph->img->SetAntiAliasing();

        $graph->yaxis->HideZeroLabel();
        $graph->yaxis->HideLine(false);
        $graph->yaxis->HideTicks(false,false);

        $graph->xgrid->Show();
        $graph->xgrid->SetLineStyle("solid");
        //$months = $this->buildArrayMonthName('2015-01-01','2016-01-01');
        //$graph->xaxis->SetTickLabels(array('Ene','Feb','Mar','Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Nov', 'Oct', 'Dic', 'Aux'));
        $graph->xaxis->SetTickLabels($resultNames);
        $graph->xgrid->SetColor('#E3E3E3');

        // Create the first line
        $p1 = new LinePlot($datay1);
        $graph->Add($p1);
        $p1->SetColor("#6495ED");
        $p1->SetLegend('Tienda 1');

        // Create the second line
        $p2 = new LinePlot($datay2);
        $graph->Add($p2);
        $p2->SetColor("#B22222");
        $p2->SetLegend('Tienda 2');

        // Create the third line
        $p3 = new LinePlot($result);
        $graph->Add($p3);

//        $p3->SetColor("#55bbdd");
        $p3->SetColor("blue");
        $p3->SetLegend('Tienda 3');
        $p3->SetCSIMTargets($targ1,$alts1);
        //-----------
        //$p3->value->SetFormat('%d');
        
        
        $p3->value->Show();
        $p3->value->SetColor('red');
        $graph->legend->SetFrameWeight(1);

        // Output line
        $graph->Stroke();

    }

    public function numberDaysBetweenTwoDates($dateStart, $dateEnd){
    $days = (strtotime($dateStart)-strtotime($dateEnd))/86400;
    $days = abs($days); $days = floor($days);     
    return $days + 1;
    }


    public function numberMonthBetweenTwoDates($dateStart, $dateEnd){
        $datetime1=new DateTime($dateStart);
        $datetime2=new DateTime($dateEnd);

        # obtenemos la diferencia entre las dos fechas
        $interval=$datetime2->diff($datetime1);

        # obtenemos la diferencia en meses
        $intervalMeses=$interval->format("%m");
        # obtenemos la diferencia en años y la multiplicamos por 12 para tener los meses
        $intervalAnos = $interval->format("%y")*12;

        //echo "hay una diferencia de ".($intervalMeses+$intervalAnos)." meses";
        return $intervalMeses + $intervalAnos + 1;
    }


    function numberDaysPerMonth($Year, $Month){
        //Si la extensión que mencioné está instalada, usamos esa.
        if( is_callable("cal_days_in_month")){
            return cal_days_in_month(CAL_GREGORIAN, $Month, $Year);
        }else{
            //Lo hacemos a mi manera.
            return date("d",mktime(0,0,0,$Month+1,0,$Year));
        }
    }


     public function obtainInfoDate($date, $var){
        $dateAux= strtotime($date);
        $value = date($var ,$dateAux);
        return $value;
    }


    public function obtainInfoFromDate($date){
        //$dateTime = new DateTime($date);
        $dateAux= strtotime($date);
        $anio = date("Y",$dateAux);
        $mes = date("m",$dateAux);
        $dia = date("d",$dateAux);

        //$ahora= time();
        //$anno = date("Y",$ahora);
        //$mes = date("n",$ahora);
        //$dia = date("d",$ahora);

        return $mes;
    }
    /*
    public function builDaysNumberListPerMonth(){
        $dateStart = '2013-01-01';
        $dateEnd = '2014-01-01';

        $numberTotalDays = $this->numberDaysBetweenTwoDates($dateStart, $dateEnd);
        $numberTotalMonth = $this->numberMonthBetweenTwoDates($dateStart, $dateEnd);

        $yearStart = $this->obtainInfoDate($dateStart, "Y");
        $monthStart = $this->obtainInfoDate($dateStart, 'm');
        $dayStart = $this->obtainInfoDate($dateStart,'d');

        $yearEnd = $this->obtainInfoDate($dateEnd, "Y");
        $monthEnd = $this->obtainInfoDate($dateEnd, "m");
        $dayEnd = $this->obtainInfoDate($dateEnd, "d");

        $arrayMonthNames = buildMonthName($numberTotalMonth, $monthStar, $monthEnd);

    }
    */


    public function buildArrayMonthName($dateStart, $dateEnd){

        $numberTotalMonths = $this->numberMonthBetweenTwoDates($dateStart, $dateEnd);
        $monthStart = $this->obtainInfoDate($dateStart, 'n');
        $monthEnd = $this->obtainInfoDate($dateEnd, 'n');
        
        $monthNames = array('Ene','Feb','Mar','Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic');
        $result = array();
        $counter = $monthStart - 1;
        
        for ($i=0; $i<$numberTotalMonths; $i++) { 
                $result[] = $monthNames[$counter];
                $counter++;
                if($counter == 12){
                    $counter = 0;
                }
        }

        return $result;
    }

/*
    public function buildArrayPercentageCompletionPerMonth($dateStart, $dateEnd){
        
        $numberTotalDays = $this->numberDaysBetweenTwoDates($dateStart, $dateEnd);
        $numberTotalMonths = $this->numberMonthBetweenTwoDates($dateStart, $dateEnd);

        $yearStart = $this->obtainInfoDate($dateStart, "Y");
        $monthStart = $this->obtainInfoDate($dateStart, 'm');
        $dayStart = $this->obtainInfoDate($dateStart,'d');

        $yearEnd = $this->obtainInfoDate($dateEnd, "Y");
        $monthEnd = $this->obtainInfoDate($dateEnd, "m");
        $dayEnd = $this->obtainInfoDate($dateEnd, "d");

        $result = array();
        $MonthCount = $monthStar;
        $yearCount = $yearStart;
        $daysElapsed = 0;
        $percentaje = 0;
        $days = 0;
        for ($i = 1; $i <= $numberTotalMonths; $i++) { 
            if($i == 1){
                $resutl[] = $monthNames[$counter];
                $days = $this->numberDaysFirstMonth($yearCount, $monthCount, $dayStart);
                $daysElapsed = $daysElapsed + $days;
                $percentaje = $this->calculatePercentage($numberTotalDays, $daysElapsed);
                $result[] = $perncetaje;

            }elseif ($i == $numberTotalMonths) {
                $resutl[] = $monthNames[$counter];
//                $days = $this->numberDaysPerMonth($yearCount, $monthCount);
                $days = $dayEnd;
                $daysElapsed = $daysElapsed + $days;
                $percentaje = $this->calculatePercentage($numberTotalDays, $daysElapsed);
                $result[] = $percentaje;
            }else {
                $resutl[] = $monthNames[$counter];
                $days = $this->numberDaysPerMonth($yearCount, $monthCount);
                $daysElapsed = $daysElapse + $days;
                $percentaje = $this->calculatePercentage($numberTotalDays, $daysElapsed);
                $result[] = $percentaje;
            }

                
                $counter++;
                if($counter == 12){
                    $counter = 1;
                    $yearStart++;
                }
        }
        return $result;   
    }
    
    */

    public function numberDaysFirstMonth($Year, $Month, $day){
        $totalDays = $this->numberDaysPerMonth($Year, $Month);
        $resutl;
        if($totalDays == $day){
            $result = 1;
        }else{
            $result = $totalDays - $day;
            $result++;
        }
        return $result;
    }


    public function buildMonthName($numberMonthTotal, $monthStart, $monthEnd){
        $monthNames = array('Ene','Feb','Mar','Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Nov', 'Oct', 'Dic');
        $result = array();
        $counter = $monthStar;
        for ($i=0; $i<$numberMonthTotal; $i++) { 
                $resutl[] = $monthNames[$counter];
                $counter++;
                if($counter == 12){
                    $counter = 1;
                }
        }
        return $result;
    }

    public function calculatePercentage($numberTotalDays, $numberElapsedDays){
        //return $numberTotalDays + $numberElapsedDays;
        //$result = (100 * $numberElapsedDays) / $numberTotalDays;
        return round((100 * $numberElapsedDays) / $numberTotalDays, 2);

    }

}

?>