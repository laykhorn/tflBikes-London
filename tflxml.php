<HTML>
<head>
    <title>tflBikes: Stations</title>
    <!-- use stye sheets to style key elements -->
    <style type="text/css">
    body,html {
	background:#FF69B4;
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

    </style>
</head>
<BODY>
<?php 
$xml = simplexml_load_file('http://www.staff.city.ac.uk/cagatay.turkay.1/Teaching/Resources/INM343/tflStations.xml');
echo "<h2>The results for King Edward Walk, Waterloo are below - by Olamilekan Raheem</h2><br/><ol>";

foreach($xml->station as $station)
{	

	if($station->name == "King Edward Walk, Waterloo")
	{
	echo '<li><strong>'.$station->nb_empty_docks.'</strong> empty,  <b>'.$station->nb_bikes.'</b> bikes @ '.$station->name.' </li><br/>';
	
	}
}
echo "</ol>";
?>
</body>

</html>