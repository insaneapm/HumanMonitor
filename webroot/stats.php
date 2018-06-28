<?php

require('db.php');
include('auth.php');

$file = $_POST['fileID'];
$username = $_SESSION['username'];
$query="SELECT CONVERT(data using UTF8) FROM `data` WHERE username='$username' AND fileID='$file'";
$result = mysqli_query($con,$query) or die(mysql_error());
$row = mysqli_fetch_assoc($result);
$str = strval($row['CONVERT(data using UTF8)']);
$str = explode(';',$str);
$arrval =[];
$arrdate = [];

foreach($str as $i){
	$i=explode('@',$i);
	$arrval[] = $i[0];
	$arrdate[] = $i[1];
}
 $arrvaljs = json_encode($arrval);
 $arrdatejs = json_encode($arrdate);
 ?>


<!DOCTYPE html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
<canvas id="myChart" width="400" height="200"></canvas>
<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?= $arrdatejs ?>,
        datasets: [{
            label: 'TotalPerson(time)',
            data: <?= $arrvaljs ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:false
                }
            }]
        }
    }
});
</script>