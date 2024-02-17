<?php
	include("connection.php");
	$category = $_POST['category'];
	$percentile = $_POST['percentile'];
	$name = $_POST['name'];
	$query = "";
	$res = "";
	if($percentile>=90)
	{
	$query = "SELECT * FROM $category WHERE CutOff between ($percentile-0.25) and ($percentile+0.25) ORDER BY CutOff DESC";
	$res = mysqli_query($connect,$query);
	}
	else if($percentile>=70 && $percentile<90)
	{
	$query = "SELECT * FROM $category WHERE CutOff between ($percentile-5) and ($percentile+5) ORDER BY CutOff DESC";
	$res = mysqli_query($connect,$query);
	}
	else
	{
	$query = "SELECT * FROM $category WHERE CutOff < $percentile ORDER BY CutOff DESC";
	$res = mysqli_query($connect,$query);
	}
	$emparray = array();
    while($row = mysqli_fetch_assoc($res))
    {
        $emparray[] = $row;
    }
    echo json_encode($emparray);
?>
