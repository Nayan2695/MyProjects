<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portal";
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
		insertinfo();
		break;
    }
    case 'getinfo':
        {
            getdata();
            break;
        }
	case 'deleteinfo':
		{
				deleteinfo();
				break;		  
		}
	case 'editinfo';
		{
			editinfo();
		}				
	default:
	break;
}
function getData()
{ 
	global $conn;
    $Search=$_POST['Search'];
	$result=array();
	$result["result"]=-1;
	$result["data"]=array();
	$result["msg"]="No data found.";
	$query1="SELECT I.Name,I.Email,I.PhoneNumber,I.DateOfBirth,I.CallTime,I.EmployeeType,I.Skills,I.Hobbies,I.PersonalDeatils FROM information I WHERE Name LIKE '%{$Search}%'";
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
function insertinfo()
{  
	global $conn;
	$Name = $_POST['name'];
	$Email = $_POST['email'];
	$PhoneNumber = $_POST['phonenumber'];
	$Date =date('y-m-d',strtotime($_POST['date']));
	$CallTime=$_POST['CallTime'];
	$EmployeeType = $_POST['EmployeeType'];
    $Skills=$_POST['Skills'];	
    $Hobbies = $_POST['hobbies'];
    $Details = $_POST['details'];
	$result=array();
	$result["result"]=-1;
	$result["msg"]="Could not add data."; 
    $query="insert into information(Name,Email,PhoneNumber,DateOfBirth,CallTime,EmployeeType,Skills,Hobbies,PersonalDeatils) values ('$Name', '$Email','$PhoneNumber', '$Date','$CallTime','$EmployeeType','$Skills','$Hobbies','$Details')";
	$queryresult = mysqli_query($conn,$query);
	if($queryresult)
	{	
		$result["result"]=1;
        $result["msg"]="Data added successfully.";	
		
	} 
	echo json_encode($result);
	mysqli_close($conn);
	exit;
}
function deleteinfo()
{ 

	global $conn;
	$Name=$_POST['Name'];
	$result=array();
	$result["result"]=-1;
	$result["msg"]="couldnt delete data.";
	$qry2="DELETE FROM information WHERE Name='".$Name."'";
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
function editinfo()
{
	global $conn;
	$Name=$_POST["Name"];
	$result=array();
	$result["data"]=array();
	$result["result"]=-1;
	$result["msg"]="Couldnt edit data.";
	$qry3="SELECT I.Name,I.Email,I.PhoneNumber,I.Hobbies,I.PersonalDeatils FROM information I WHERE Name='".$Name."'";
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