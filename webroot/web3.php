<?php 
	require('db.php');
	session_start();
	include("auth.php");
	$username=$_SESSION['username'];
	$query = "SELECT MAX(user_nb_file) FROM `data` WHERE username='$username'";
	$result = mysqli_query($con,$query) or die(mysql_error());
	$row = mysqli_fetch_assoc( $result);
	$_SESSION['nbfile']=intval($row['MAX(user_nb_file)']);
	$_SESSION['maxfile']=$_SESSION['nbfile'];

	$query = "SELECT * FROM `data` WHERE username='$username' ORDER BY user_nb_file DESC LIMIT 1";
	$result = mysqli_query($con,$query) or die(mysql_error());
	$row = mysqli_fetch_assoc( $result);
	$_SESSION['fileID'] = intval($row['fileID']);

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/signalr/jquery.signalr-2.2.2.min.js"></script>
<script type="text/javascript" src="https://cdn.myconstellation.io/js/Constellation-1.8.2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
<script type="text/javascript" src="./js/external/FileSaver.js"></script>
<script type="text/javascript" src="./js/external/Cookies.js"></script>
<script type="text/javascript" src="./js/userConfig.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>

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
        <div style="float:right;">xx</div> 
        <p>
            AccessKey: 
            <input id="user1" type="text" class="selectable" size="41" />
        </p>
        <p>
            Constellation URL:
            <input id="user2" type="text" class="selectable" size="37" />
        </p>
        <p>
            Friendly Name:
            <input id="user3" type="text" class="selectable" size="46" />
        </p>
        <p>
            <button id="saveUser" onclick="">Save</button>
        </p>
				<?php echo '<pre>';
		var_dump($_SESSION);
		echo '</pre>';
			?>

    </div>

	<div id="2" class="content"> </div>
	<div id="3" class="content"> </div>

    <div id="4" class="content">
        <h1>Control Center</h1>

        <p>
            <span id="cpu" ></span>
			<br /> <br /> 
			Start logging : 
            <button id="LogsButton" onclick="LogsButton();" class='hiddenbutton' ><img src='/res/play.png' width=20 height=20 /></button>
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

			Add file : <button id="AddFileButton" onclick="addFile();" class='hiddenbutton'><img src='/res/plus.png' width=20 height=20 /></button>

    </div>

    <div id="5" class="content">	
        <h1>Statistics</h1>
        <p>Choose a file to get stats from: 
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

		<button onclick="selectFileForStats("10");">azea</button>

		<p id="filestat">
			<select onchange="selectFileForStats(this.value)">
			<option value="">Select file:</option>
			<option value=""></option>
			</select>
		</p>


        <div style="width:75%;">
            <canvas id="canvas"></canvas>
        </div>
    </div>

</body>

</html>

	
<script>
	isLogging=false;
	selectFile('<?= $_SESSION['maxfile'] ?>');
	function LogsButton(){
		if (isLogging===true){
			isLogging=false;
			document.getElementById('LogsButton').innerHTML = "<img src='/res/play.png' width=20 height=20 />";
		}
		else{
			isLogging=true;
			document.getElementById('LogsButton').innerHTML = "<img src='/res/pause.png' width=20 height=20 />";

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

	var constellation = $.signalR.createConstellationConsumer("<?=$_SESSION['constellation_url']?>","<?=$_SESSION['constellation_access_key']?>","<?=$_SESSION['constellation_friendly_name']?>");
    constellation.connection.stateChanged(function (change) {
        if (change.newState === $.signalR.connectionState.connected) {
            console.log("Je suis connecté");
            constellation.client.registerStateObjectLink("LAPTOP-1R5A4JK5_UI", "HWMonitor", "/intelcpu/0/load/0", "*", function (so) {
                $("#cpu").text(so.Value.Value);
				if (isLogging===true){
					saveData(String(so.Value.Value)); 
				}
				})
        }
    });

	/*
    var ctx = document.getElementById("canvas");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ,
            datasets: [{
                label: 'Label a changer',
                data: ,
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
                        beginAtZero: true
                    }
                }]
            }
        }
    });
	*/					
    constellation.connection.start();

</script>

