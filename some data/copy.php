<?php 
session_start();
if(isset($_SESSION["custid"])){
include("connection.php");
$custid=$_SESSION["custid"];
$custid_sql = mysqli_query($conn,"SELECT * FROM  tbl_users where id='$custid'");
                                  $custid_row= mysqli_fetch_array($custid_sql);    
                                  $tbl_roles_id=$custid_row['tbl_roles_id'];  
                                  $city_id= $_GET["city_id"];  



  
 
if (isset($_POST['submit_sms'])) { 
	 
	date_default_timezone_set("Asia/Kolkata");
	$today= date('Y-m-d');
	$name = mysqli_real_escape_string($conn,$_REQUEST['name']); 
   $target = mysqli_real_escape_string($conn,$_REQUEST['target']); 

 


$import="INSERT into tbl_leads_type(name,traget_data,simplified_name) values('$name','$target','$name')";
$result=mysqli_query($conn,$import);

    ?>
<script language="javascript">window.location.href="product_com.php";</script>
<?php 
  
}




if (isset($_POST['submit_email_update'])) { 
	 
	date_default_timezone_set("Asia/Kolkata");
	$today= date('Y-m-d');
	$cm_id = $_REQUEST['token']; 
	$name = mysqli_real_escape_string($conn,$_REQUEST['name']); 
   $target = mysqli_real_escape_string($conn,$_REQUEST['target']); 



  $result = mysqli_query($conn,"UPDATE tbl_leads_type SET name='$name',simplified_name='$name',traget_data='$target' WHERE id='$cm_id'");

    ?>
<script language="javascript">window.location.href="product_com.php";</script>
<?php 
  
}




 
?>
<?php }
else
{
?>
<script language="javascript">window.location.href="login.php";</script>
<?php   
}?>




