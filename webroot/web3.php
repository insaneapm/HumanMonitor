<?php 
	require('db.php');
	session_start();
	include("auth.php");
	$username=$_SESSION['username'];
	$query = "SELECT MAX(user_nb_file) FROM `data` WHERE username='$username'";
	$result = mysqli_query($con,$query) or die(mysql_error());
	$row = mysqli_fetch_assoc( $result);
	$_SESSION['last_user_nb_file']=intval($row['MAX(user_nb_file)']);

	$query = "SELECT * FROM `data` WHERE username='$username' ORDER BY user_nb_file DESC LIMIT 1";
	$result = mysqli_query($con,$query) or die(mysql_error());
	$row = mysqli_fetch_assoc( $result);
	$_SESSION['last_fileID'] = intval($row['fileID']);

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/signalr/jquery.signalr-2.2.2.min.js"></script>
<script type="text/javascript" src="https://cdn.myconstellation.io/js/Constellation-1.8.2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
<script type="text/javascript" src="./js/external/FileSaver.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script type="text/javascript" src="/js/date.js"></script>

<head>
    <style>
        .shadow {
            box-shadow: 0px 0px 20px 0px rgb(128, 128, 128);
        }

        * {
            box-sizing: border-box;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
		
        .selectable {
            -webkit-touch-callout: inherit;
            -webkit-user-select: text;
            -khtml-user-select: text;
            -moz-user-select: text;
            -ms-user-select: text;
            user-select: text;
        }

        body {
            margin: 0;
			background-color: rgb(229, 229, 229);
            font-family: Arial, Helvetica, sans-serif;
        }

		.canvastest{
			margin:0 auto 20px auto; 
			display:block	; 
			cursor:crosshair
		}

        /* Style the side navigation */
        .sidenav {
            height: 100%;
            width: 200px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: rgb(170,170,170);
            overflow-x: hidden;
        }



            /* Side navigation links */
            .sidenav a {
                color: white;
                padding: 16px;
                text-decoration: none;
                display: block;
            }

                /* Change color on hover */
                .sidenav a:hover {
                    box-shadow: -5px 5px 13px 5px rgb(128, 128, 128);
                    text-shadow: 0px 0px 10px rgb(165, 165, 165);
                    background-color: white;
                    color: black;
                }

        /* Style the content */
        .content {
            margin-left: 220px;
            padding-left: 20px;
        }

		.hiddenbutton {

			background: transparent;
			border: none !important;
			font-size:0;
		}
    </style>
    <meta charset="utf-8" />
    <title>Interface Web</title>
</head>

<body>

    <div class="sidenav shadow" id="navbar">
        <a id="nav1" class="unselectable" onclick="navigation(1);">SETTINGS</a>
        <a id="nav2" class="unselectable" onclick="navigation(2);">MAP SETUP</a>
        <a id="nav3" class="unselectable" onclick="navigation(3);">MAP VIEW</a>
        <a id="nav4" class="unselectable" onclick="navigation(4);">CONTROL CENTER</a>
        <a id="nav5" class="unselectable" onclick="navigation(5);">STATISTICS</a>
    </div>

    <div id="1" class="content">
        <h1>Settings</h1>
		<hr align="left" width="15%" color="black" size="3">  <br />
        <div style="float:right;">xx</div>
		
		<form action="saveusercfg.php" method="get">
			Constellation Access Key: <input type="password" size="41" name="constellation_access_key" placeholder="<?=$_SESSION['constellation_access_key']?>"><br>
			Constellation URL: <input type="text" size="30" name="constellation_url" placeholder="<?=$_SESSION['constellation_url']?>"><br>
			Constellation Friendly Name: <input type="text" name="constellation_friendly_name" placeholder="<?=$_SESSION['constellation_friendly_name']?>"><br>
			<br /><input type="submit">
		</form>
		<br />
				<?php echo '<pre>';
		var_dump($_SESSION);
		echo '</pre>';
			?>

    </div>

	<div id="2" class="content"> </div>
	<div id="3" class="content"> 
	        <h1>Map View</h1>
			<hr align="left" width="15%" color="black" size="3"> <br />
			<canvas class="canvastest" id="mapCanvas" width="600" height="600" > </canvas>
		<script>
			var mainCanvas = document.getElementById("mapCanvas");
			var mainContext = mainCanvas.getContext("2d");
			var canvasWidth = mainCanvas.width;
			var canvasHeight = mainCanvas.height;


			function drawBase() {    
				
				mainContext.fillStyle = "#DDDDDD";
				mainContext.fillRect(0, 0, canvasWidth, canvasHeight);
				mainContext.fillStyle = "#000000";
				mainContext.fillRect(100,200,300,200);
				mainContext.fillStyle = "#DDDDDD";
				mainContext.fillRect(105,205,290,190);
				mainContext.fillRect(300,200,50,10);
				
			}
			drawBase();

		</script>

		
	</div>


    <div id="4" class="content">
        <h1>Control Center</h1>
		<hr align="left" width="15%" color="black" size="3"> <br />
        <p>
            <span id="nbp" ></span>
				<br />  <br />  
            <button id="LogsButton" onclick="LogsButton();" class='hiddenbutton' ><img src='/res/play.png' width=125 height=40 /></button>
		</p>
		<br />
		<script>
		function selectFile(file){
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200){
					document.getElementById("selectFileID").innerHTML = this.responseText;
				}
			}
			xmlhttp.open("GET","selectfile.php?filesel="+file,true);
			xmlhttp.send();
		}
		</script>

        <div id="selectFileID">
		aziueaiuzes
		</div>

		<script>
				function addFile(){
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200){
					location.reload();
				}
			}
			xmlhttp.open("GET","addfile.php",true);
			xmlhttp.send();
			}
		</script>
			<br />
			<button id="AddFileButton" onclick="addFile();" class='hiddenbutton'><img src='/res/plus.png' width=125 height=40 /></button>

    </div>

    <div id="5" class="content">	
        <h1>Statistics</h1>
		<hr align="left" width="15%" color="black" size="3">  <br />
        <p>Live stats :
        </p>

		<script>
		function selectFileForStats(file){
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200){
					document.getElementById("filestat").innerHTML = this.responseText;
				}
			}
			xmlhttp.open("GET","selectfileforstats.php?fileidforstats="+file,true);
			xmlhttp.send();
		}
		</script>



		<canvas id="myChart" width="300" height="100"></canvas>


        <div style="width:100%;">
            <canvas id="canvas"></canvas>
        </div>

		        <p>Choose a file to get stats from: 
        </p>
				<div id="">
			<form target="_blank" action="stats.php" method="post">
			<input type="text" name="fileID" placeholder="fileID" required />
			<input name="submit" type="submit" value="ok" />
		</div>
    </div>

</body>

</html>

	
<script>
	isLogging=false;
	locallogarray_vals=[];
	locallogarray_date=[];
	locallogarray_val =0;
	selectFile('<?= $_SESSION['last_user_nb_file'] ?>');
	function LogsButton(){
		if (isLogging===true){
			isLogging=false;
			document.getElementById('LogsButton').innerHTML = "<img src='/res/play.png' width=125 height=40 />";
		}
		else{
			isLogging=true;
			document.getElementById('LogsButton').innerHTML = "<img src='/res/pause.png' width=125 height=40 />";

		}
	}


    function navigation(id) {
        var elementsNavbar = document.getElementById('navbar').childElementCount;
        for (var i = 1; i <= elementsNavbar; i++) {
            if (i != id) {
                document.getElementById(String(i)).style.display = 'none';
            }
            else {
                document.getElementById(String(id)).style.display = 'block';
            }
        }

    }

    navigation(1);

	function saveData(val) {
		xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","data.php?data="+val,true);
        xmlhttp.send();
	}

	//cpu
	var constellation = $.signalR.createConstellationConsumer("<?=$_SESSION['constellation_url']?>","<?=$_SESSION['constellation_access_key']?>","<?=$_SESSION['constellation_friendly_name']?>");
    constellation.connection.stateChanged(function (change) {
        if (change.newState === $.signalR.connectionState.connected) {
            console.log("Je suis connecté");
            constellation.client.registerStateObjectLink("LAPTOP-1R5A4JK5_UI", "HWMonitor", "/intelcpu/0/load/0", "*", function (so) {
                $("#nbp").text(so.Value.Value);
				if (isLogging===true){
					saveData(String(so.Value.Value));
					locallogarray_vals.push(String(so.Value.Value));
					date= new Date();
					if data.toString('');
					locallogarray_date.push(date.toString('dd-MM-yy - HH:mm:ss'));
					myChart.update();

				}
				})
        }
    });

	//humanmonitor
	/*
	var constellation = $.signalR.createConstellationConsumer("<?=$_SESSION['constellation_url']?>","<?=$_SESSION['constellation_access_key']?>","<?=$_SESSION['constellation_friendly_name']?>");
    constellation.connection.stateChanged(function (change) {
        if (change.newState === $.signalR.connectionState.connected) {
            console.log("Je suis connecté");
            constellation.client.registerStateObjectLink("Developer", "ConstellationPackageConsole1", "Population", "*", function (so) {
                $("#nbp").text(so.Value);
				if (isLogging===true){
					saveData(String(so.Value)); 
					locallogarray_vals.push(String(locallogarray_val));	
					date= new Date();
					datestr="";
					datestr.concat(String(date.getDay()),"-",String(date.getMonth()),"-",String(date.getYear()).substr(2)," ",String(date.getHours()),":",String(date.getMinutes()),":",String(date.getSeconds()));
					locallogarray_date.push(datestr);
					myChart.update();
				}
				})
        }
    });
*/ 
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: locallogarray_date,
            datasets: [{
                label: 'TotalPerson(time)',
                data: locallogarray_vals,
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
                borderWidth:1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    constellation.connection.start();

</script>

