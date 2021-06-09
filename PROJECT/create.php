<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = mysqli_connect($servername, $username, $password,$dbname);
if($conn === false)
 {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$request = $_REQUEST['request'];
switch($request)
{
	case 'adddata':
    {
		insertdata();
		break;
	}
	case 'getData':
    {
		getData();
		break;
	}
	case 'deleteData':
	{
	    deleteData();
		break;		  
	}	
	case 'editData';
	{
		editData();
	}	
	default:
	break;
}		   
function insertdata()
{  
	global $conn;
    $getNum=$_POST['getNum'];
	$NAME = $_POST['NAME'];	
	$result=array();
	$result["result"]=-1;
	$result["msg"]="Could not add data.";
	$qry="SELECT * FROM postprocessingmaster WHERE SlNO=$getNum";
	$queryresult=mysqli_query($conn,$qry);
	if($queryresult->num_rows > 0)
	{
		$query1="UPDATE postprocessingmaster SET NAME='".$NAME."' WHERE SlNO=".$getNum;
		$result["msg"]="Employeee information updated successfully.";
	}
	else
	{
	$query1="INSERT INTO postprocessingmaster (Name) VALUES ('$NAME')";
	$result["msg"]="Data added successfully.";	
	}
	$queryresult1 = mysqli_query($conn,$query1);
	if($queryresult1)
	{	
		$result["result"]=1;
		
	} 
	echo json_encode($result);
	mysqli_close($conn);
	exit;
}
function getData()
{
	global $conn;
	$result=array();
	$result["result"]=-1;
	$result["data"]=array();
	$result["msg"]="No data found.";
	$query2="SELECT P.SlNO,P.Name,DATE_FORMAT(P.Timestamp,'%m-%d-%y') AS Timestamp,P.UserIndex,P.CompanyId FROM postprocessingmaster P  "; 
    $queryresult2= mysqli_query($conn,$query2);	
	if($queryresult2->num_rows>0) 
	{
		$result["result"]=1;
		$result["msg"]="Data found.";
	   while($rows = mysqli_fetch_assoc($queryresult2))
		{
			array_push($result["data"],$rows);
		}
	}
	echo json_encode($result);
	mysqli_close($conn);
	exit;
}
function editData()
{
	global $conn;
	$SlNO=$_POST["SlNO"];
	$result=array();
	$result["result"]=-1;
	$result["msg"]="Couldnt edit data.";
	$query3="SELECT P.Name,P.SlNO FROM postprocessingmaster P WHERE SlNO=$SlNO";
	$queryresult3=mysqli_query($conn,$query3);
	if($queryresult3) 
	{
		$row = mysqli_fetch_assoc($queryresult3);
		$result["Name"]=$row['Name'];
		$result["SlNO"]=$row['SlNO'];
		$result["result"]=1;
		$result["msg"]="Data found.";
	}
	echo json_encode($result);
	mysqli_close($conn);
	exit;
}
function deleteData()
{
	global $conn;
	$SlNUM=$_POST['SlNUM'];
	$result=array();
	$result["result"]=-1;
	$result["msg"]="couldnt delete data.";
	$qry2="DELETE FROM postprocessingmaster WHERE SlNO=$SlNUM";
	$queryresult2=mysqli_query($conn,$qry2);
	if($queryresult2) 
	{
		$result["result"]=1;
		$result["msg"]="Row deleted successfully.";
	}
	echo json_encode($result);
	mysqli_close($conn);
	exit;
}
?>