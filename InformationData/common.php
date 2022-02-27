<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data";
$conn = mysqli_connect($servername, $username, $password,$dbname);
if($conn === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$request = $_REQUEST['request'];
switch($request)
{
	case 'addinfo':
    {
		insertdata();
		break;
    }
    case 'getinfo':
    {
            getdata();
            break;
     }
	default:
	break;
}	
function insertdata()
{
    global $conn;
    $Id=$_POST["Id"];
	$Name=$_POST["Name"];
	$Age=$_POST["Age"];
	$Gender=$_POST["Gender"];
	$Email=$_POST["Email"];
    $PhoneNumber=$_POST["PhoneNumber"];
    $Place=$_POST["Place"];
    $JoinDate=$_POST["JoinDate"];
    $EndDate=$_POST["EndDate"];
	$result=array();
	$result["result"]=-1;
	$result["msg"]="Could not add data."; 
	$qry="INSERT INTO `informationdata`(`Id`, `Name`, `Age`, `Gender`, `Email`, `PhoneNumber`, `Place`, `JoinDate`, `EndDate`) VALUES ('$Id','$Name','$Age','$Gender','$Email','$PhoneNumber','$Place','$JoinDate','$EndDate')";
	$result["msg"]="Data added successfully.";	
	$queryresult= mysqli_query($conn,$qry);
	if($queryresult)
	{	
		$result["result"]=1;
		
	} 
	echo json_encode($result);
	mysqli_close($conn);
	exit;
}function getdata()
{ 
	global $conn;
	$result=array();
	$result["result"]=-1;
	$result["data"]=array();
	$result["msg"]="No data found.";
	$query1="SELECT I.Id, I.Name, I.Age, I.Gender, I.Email, I.PhoneNumber, I.Place, I.JoinDate, I.EndDate FROM informationdata AS I";
    $queryresult1= mysqli_query($conn,$query1);	
	if($queryresult1->num_rows>0) 
	{
		$result["result"]=1;
		$result["msg"]="Data found.";
		while($rows = mysqli_fetch_assoc($queryresult1)) 
		{
			array_push($result["data"],$rows);
		}
	}
	echo json_encode($result);
	mysqli_close($conn);
	exit;
}


?>