<?php 

function buildCalender($month,$year){

    $daysOfWeek         = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");//days of week in array
    $firstDayOfMonth    = mktime(0,0,0,$month,1,$year);//get the first day in week //mktime(hour,mnuite,second,month,day,year)
    $numberDaysOfMonth  = date("t",$firstDayOfMonth);//get number of days in one month

    $dateComponents     = getdate($firstDayOfMonth);//for getting information like days, week, year, month, number of day in week...

    $monthName          = $dateComponents["month"];
    $numberOfDayInWeek  = $dateComponents["wday"];//getting number day in week so between 0 to 6 
    $dateToday          = date("Y-m-d");

    $calender           ='<table class="table table-bordered">';
    $calender          .="<h2 class='title-calender'>$monthName $year</h2>";
    $calender          .='<div class="title-calender"><a href="?month='.date("m",mktime(0,0,0,$month-1,1,$year)).'&year='.date("Y",mktime(0,0,0,$month-1,1,$year)).'" type="button" class="btn btn-primary">Prview</a>';
    $calender          .='<a href="?month='.date("m",mktime(0,0,0,$month+1,1,$year)).'&year='.date("Y",mktime(0,0,0,$month+1,1,$year)).'" type="button" class="btn btn-primary">Next</a></div>';
    $calender          .='<thead><tr>';



    foreach ($daysOfWeek as $key ) {
        $calender .='<th scope="col">'.$key.'</th>';
    }

    $calender          .='</tr></thead>';
    $calender          .='<tbody><tr>';

    // لترك الفراغات ثم يبدا بوضع الارقام
    if ($numberOfDayInWeek > 0) {
        for($i=0;$i < $numberOfDayInWeek; $i++ ){
            $calender          .='<td></td>';
        }
    }

    $currentDay      = 1;
    while ($currentDay <= $numberDaysOfMonth) {
        //echo '<script> alert ('.$numberOfDayInWeek.')</script>';
            if ($numberOfDayInWeek == 7) {
                $numberOfDayInWeek = 0;
                $calender         .= '</tr><tr>';
            }

            //$date        = "$year-$month-$currentDay";
            $calender   .='<td>'.$currentDay.'</td>';

            $currentDay++;
            $numberOfDayInWeek++;

            
    }

    $calender          .='</tbody>';
    $calender          .='</table>';

    echo $calender;

}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
        .title-calender{
            display: flex;
            justify-content: center;
            padding-bottom: 15px;
        }
    </style>
  </head>
  <body>


    <div class="container">
        <div class="row"><!-- start row-->
            <div class="col-md">
                <?php 
                $date   = getdate();
                if(isset($_GET["month"]) && isset($_GET["year"])){
                    $month  = $_GET["month"];
                    $year   = $_GET["year"];
                    buildCalender($month,$year);
                }else{
                    $month  = $date["mon"];
                    $year  = $date["year"];
                    buildCalender($month,$year);
                }
                
                ?>
            </div>
        </div><!-- fin row-->
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  </body>
</html>
<!-- 

    echo "<pre>";
        print_r($dateComponents );
    echo "<pre>";
-->