<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employee";
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
	$EMPID = $_POST['EMPID'];
	$ENAME = $_POST['ENAME'];
	$MAILID = $_POST['MAILID'];
	$PNO = $_POST['PNO'];
	$address = $_POST['ADDRESS'];	
	$result=array();
	$result["result"]=-1;
	$result["msg"]="Could not add data."; 
	$qry="SELECT * FROM employeeinfo WHERE EMP_ID=$EMPID";
	$queryresult=mysqli_query($conn,$qry);
	if($queryresult->num_rows>0)
	{
		$qry1="UPDATE employeeinfo SET EMP_NAME='".$ENAME."',EMAIL_ID='".$MAILID."',PHONE_NUMBER='".$PNO."',ADDRESS='".$address."' WHERE EMP_ID=".$EMPID;
		$result["msg"]="Employeee information updated successfully.";
	}
	else
	{
		$qry1="insert into employeeinfo(EMP_ID,EMP_NAME,EMAIL_ID,PHONE_NUMBER,ADDRESS) values ('$EMPID', '$ENAME','$MAILID', '$PNO','$address')";
		$result["msg"]="Data added successfully.";	
	}
	$queryresult1 = mysqli_query($conn,$qry1);
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
	$query ="SELECT E.EMP_ID,E.EMP_NAME,E.EMAIL_ID,E.PHONE_NUMBER,E.ADDRESS,E.COMPANY_ID,C.COMPANY_NAME FROM  employeeinfo E LEFT JOIN companinfo C ON E.COMPANY_ID=C.COMPANY_ID"; 
    $queryresult= mysqli_query($conn,$query);	
	if($queryresult->num_rows>0) 
	{
		$result["result"]=1;
		$result["msg"]="Data found.";
		while($rows = mysqli_fetch_assoc($queryresult)) 
		{
			array_push($result["data"],$rows);
		}
	}
	echo json_encode($result);
	mysqli_close($conn);
	exit;
}
function deleteData()
{
	global $conn;
	$EMP_ID=$_POST["EMP_ID"];
	$result=array();
	$result["result"]=-1;
	$result["msg"]="couldnt delete data.";
	$qry2="DELETE FROM employeeinfo WHERE EMP_ID=$EMP_ID";
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
function editData()
{
	global $conn;
	$EMP_ID=$_POST["EMP_ID"];
	$result=array();
	$result["data"]=array();
	$result["result"]=-1;
	$result["msg"]="Couldnt edit data.";
	$qry3="SELECT E.EMP_ID,E.EMP_NAME,E.EMAIL_ID,E.PHONE_NUMBER,E.ADDRESS FROM employeeinfo E WHERE EMP_ID=$EMP_ID";
	$queryresult3=mysqli_query($conn,$qry3);
	if($queryresult3->num_rows>0) 
	{
		$result["result"]=1;
		$result["msg"]="Data found.";
		while($rows = mysqli_fetch_assoc($queryresult3)) 
		{
			array_push($result["data"],$rows);
		}
	}
	echo json_encode($result);
	mysqli_close($conn);
	exit;
	}
?>