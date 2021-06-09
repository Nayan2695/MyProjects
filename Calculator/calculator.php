<?php
 
 $currentValue=0;
 $input=[];
 
 function getInputAsString($values)
 {
	 $output="";
	 foreach($values as $value)
	 {
		 $output .=$value;
	 }
	 return $output;
	 
 }
 function calculateInput($userInput)
 {
	$arr=[];
    $char="";
	foreach($userInput as $num)
	{
    if(is_numeric($num) || $num == ".")
	{
		$char.=$num;
                                             
    }
	 elseif(!is_numeric($num))
	{
		if(!empty($char))
		{
			 $arr[]=$char;
			 $char="";
		}
		 $arr[] =$num;
	 } 
   }
 if(!empty($char))
 {
	 $arr[]=$char;
 }
  
  $current=0;
  $action=null;
  for($i=0; $i<=count($arr)-1;$i++)
  {
	  if(is_numeric($arr[$i]))
	  {
		if($action)
		{
		  if($action=="+")
		  {
			  $current=$current+$arr[$i];
		  }
		  if($action=="-")
		  {
			  $current=$current-$arr[$i];
		  }
		  if($action=="*")
		  {
			  $current=$current*$arr[$i];
		  }
		  if($action=="/")
		  {
			  $current=$current/$arr[$i];
		  }
		  $action=null;
	  }
	  else
	  { 
		if($current==0)
		{
			$current=$arr[$i];
		}
	  }
  }
  else
  {
	$action=$arr[$i];
  }
 }
 return $current;
 }
 if($_SERVER['REQUEST_METHOD']=="POST")
 {
	if(isset($_POST['input']))
	{
		$input=json_decode($_POST['input']);
	}
	if(isset($_POST))
	{
		foreach($_POST as $key=>$value)	
		{
			if($key == 'equal')
			{
				$currentValue=calculateInput($input);
			}
			elseif($key == "ce")
			{
				array_pop($input);
			}
			elseif($key == "c")
			{
				$input=[];
				$currentValue=0;
			}
		    elseif($key != 'input')
			{
				$input[]=$value;
			}
		
	}
	
 }
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CALCULATOR</title>
</head>
<center>
<h3>Calculator</h3>
<div style="border:1px solid #000; border-radius:3px; padding:5px; display:inline-block">
<body>
<form method="post">
<input type="hidden" name="input" value='<?php echo json_encode($input);?>'/>
<p style="padding:3px; margin:0 min-height=28px "><?php echo getInputAsString($input); ?></p>
<input type="text" value=<?php echo $currentValue; ?>>
<table border="1">
  <tr>
       <td><input type="submit" name="ce" value="CE"/></td>  
       <td><input type="submit" name="c" value="C"/></td>  
       <td><input type="submit" name="back"value="BACK"/></td>  
	   <td><input type="submit" name="divide" value="/"/></td>  
	</tr>
    <tr>
       <td><input type="submit" name="7" value="7"/></td>  
       <td><input type="submit" name="8" value="8"/></td>  
       <td><input type="submit" name="9" value="9"/></td>  
	   <td><input type="submit" name="multiply" value="*"/></td>  
	</tr>
	
	<tr>
       <td><input type="submit" name="4" value="4"/></td>  
       <td><input type="submit" name="5" value="5"/></td>  
       <td><input type="submit" name="6" value="6"/></td>   
	   <td><input type="submit" name="minus" value="-"/></td>  
	</tr>
	
	<tr>
       <td><input type="submit" name="1" value="1"/></td>  
       <td><input type="submit" name="2" value="2"/></td>  
       <td><input type="submit" name="3" value="3"/></td> 
	   <td><input type="submit" name="add" value="+"/></td>  
	</tr>
	
	<tr>
       <td><input type="submit" name="plusminus" value="+-"/></td>  
       <td><input type="submit" name="zero" value="0"/></td>  
       <td><input type="submit" name="." value="."/></td> 
	   <td><input type="submit" name="equal" value="="/></td>  
	</tr>
	
</table>
</form>
</body>
</div>
</center>
</html>