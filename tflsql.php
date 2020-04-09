<HTML>
<head>
    <title>tflBikes: Stations</title>
    <!-- use stye sheets to style key elements -->
    <style type="text/css">
    body,html {background:#FFC0CB;
	text-align: center;
	margin-top: auto;
	margin-left: auto;
	margin-right: auto;
	float: center;
	align: center;
	font-family:calibri;
	font-size:100%; 
	color: #666
	font: center;
	margin: 0px;
padding: 0px;
	}
    table    {font-size:80%;
	margin-left: auto;
	margin-right: auto;
	align: center;
	float: center;
}
    th    {background-color:#bbb}
    .cap    {background-color:#d8d8d8}
    </style>
</head>
<BODY>

<?php
$conn_error = 'Could not connect to database.';

$mysql_host = '127.0.0.1';
$mysql_user = 'root';
$mysql_pass = '';

$mysql_connect = @mysqli_connect($mysql_host, $mysql_user, $mysql_pass) or die('could not connect mysql');
$mysql_db = 'tflbikes';

if(!@mysqli_connect($mysql_host, $mysql_user, $mysql_pass) || !@mysqli_select_db($mysql_connect, $mysql_db))
{
	die($conn_error);
}

$query = "SELECT DISTINCT availableBikes, s2. * FROM tflStations AS s1 RIGHT JOIN tflStations AS s2 on 1 = 1 INNER JOIN tflBikeUsage AS u on s2.ID = u.stationId where s1.name = 'King Edward Walk, Waterloo' AND s1.easting < s2.easting + 400 AND s1.easting > s2.easting - 400 AND s1.northing < s2.northing + 400 AND s1.northing > s2.northing - 400 AND HOUR(u.t) BETWEEN (HOUR(t) > 10) AND (HOUR(t) < 16) ORDER BY capacity DESC";

if($query_run = mysqli_query($mysql_connect, $query))
{
	if(mysqli_num_rows($query_run)==NULL)
	{
		echo 'No results found for selection.';
	}
	else
	{	echo "<div>\n";
echo 
"<h2>TFLBIKES STATIONS</h2><br/>";
echo "<table border=2 cellpadding=5 cellspacing=5 background-color=#0000ff>
  <tr>
    <th>Average bikes available</th>
    <th>Station Capacity</th>
    <th>Station name</th>
    <th>Post Code</th>
  </tr>";
		while($query_row = mysqli_fetch_assoc($query_run))
		{
			$capacity = $query_row['capacity'];
			$stationName = $query_row['name'];
			$postcode = $query_row['postCode'];
			$bikes = $query_row['availableBikes'];
			 $average = round(($bikes/$capacity)*100, 1);
			
			//echo $stationName.' with postcode'.$postcode .'has '.$capacity.' capacity.<br/>
	echo		  "<tr>";
    echo "<th>".$average."</th>";
    echo "<th>".$capacity."</th>";
    echo "<th>".$stationName."</th>";
    echo "<th>".$postcode."</th>";
  echo "</tr>";
		}
	}
	echo "\n</div>";
}
else
{
	echo mysqli_error($mysql_connect);
}
?>

</BODY>
</HTML>