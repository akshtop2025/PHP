<?php
require_once 'DBConfigs.php';


if($db->is_loggedin())
{
  $db->redirect('home.php');
}

if(isset($_POST['submit'])){


	$res = $db->login($_POST['username'], $_POST['username'], $_POST['password'], $_POST['token']);
	//print_r($res);
	//print_r($_SESSION['token']);
	
	if($res == 1){
		header("Location: home.php");
	}
	else{
		echo $res;
		//echo $db->is_loggedin();		
		//header("Location: home.php");
	}
}

$token = $_SESSION['token'] = md5(uniqid(mt_rand(),true));
?>
<form method="POST" action="">
<table>
	<tr><td>Name:</td><td><input type="username" name="username"></td></tr>
	<tr><td>Password:</td><td><input type="password" name="password"></td></tr>
	<input type="hidden" name="token" value="<?=$token;?>">
	<input type="submit" name="submit" value="submit">
</table>
</form>