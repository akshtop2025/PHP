<?php
require_once 'DBConfigs.php';

if($db->is_loggedin() == NULL)
{
  $db->redirect('login.php');
  
}

if($db->is_timeout())
{
	$res = $db->logout();
	if($res == true){
		$db->redirect('login.php');
	}
}
//User input
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = isset($_GET['per-page']) && $_GET['per-page'] <= 50 ? (int)$_GET['per-page'] : 3;


$rec = $task->showTask($_SESSION['user_session'], $page, $perPage);

//var_dump($db->is_loggedin());
if(isset($_GET['edit'])){
	$ures = $task->getUpdateDetails($_GET['edit'], $_SESSION['user_session']);
	//$uimg = $ures['image'];
	$utask = $ures['task'];
	
}


if(isset($_GET['delete'])){
	$dres = $task->deleteTask($_GET['delete'], $_SESSION['user_session']);
	if($dres){
		//echo "deleted....";
		header("Location: home.php");
		echo "DELETED.....";
	}
	else{
		echo $dres;
	}
	
}


if(isset($_POST['Add'])){
	$res = $task->inserstTask($_POST['task'], $_POST['user_id'], $_FILES, $_POST['token']);	
	if($res == 6){
		//header("Location: home.php");
		echo "Inserted......";
	}
	else{
		echo $res;
	}
}

if(isset($_POST['cancel'])){
	$db->redirect('home.php');
}

if(isset($_POST['Edit'])){
	
	$etask = (isset($_POST['task'])?$_POST['task']:$ures['task']);
	$eimg = (isset($_FILES)?$_FILES:'uploads/'.$ures['image']);
	//print_r($eimg);
	$eres = $task->updateTask($etask, $_POST['id'], $_SESSION['user_session'], $eimg, $_POST['token']);	
	if($eres == 6){
		header("Location: home.php");
		
	}
	else{
		echo $eres;
	}

}

//print_r($ures['image']);


$token = $_SESSION['token'] = md5(uniqid(mt_rand(),true));
?>


<h1>Welcome <?php echo isset($_SESSION['user_name']) ? "".$_SESSION['user_name']."": "no session";?></h1>
<div class="right">
 <label><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i>logout</a></label>
</div>
<form method="POST" action="" enctype="multipart/form-data">
<table>
	<tr><td>Task:</td><td><input type="text" value="<?php echo isset($_GET['edit']) ? $utask : ''; ?>" name="task"></td></tr>
	<tr><td><input type="file" name="image" id="fileToUpload" accept="image/*"></td><td>
	<?php
	if(isset($ures['image'])){
	?>	
	<img src="uploads/<?=$ures['image'];?>" alt="Smiley face" height="100" width="100">
	<?php
	}
	?></td></tr>
	<input type="hidden" name="token" value="<?=$token;?>">
	<input type="hidden" name="id" value="<?=isset($_GET['edit'])?$_GET['edit']:'';?>">
	<input type="hidden" name="user_id" value="<?=$_SESSION['user_session'];?>">
	<tr><td><input type="submit" name="<?=(isset($_GET['edit'])?'Edit': 'Add');?>" value="<?=(isset($_GET['edit'])?'Edit': 'Add ');?> Task"></td><td>
		<?=isset($_GET['edit'])?"<input type='submit' name='cancel' value='cancel'>":"";?>
	</td></tr>
</table>
</form>

<?php

if($rec === 0){
	echo "no Tasks!!! Insert Task";
} 
else{
	
	//print_r($rec);
	?>
	<table>
		<thead>
			<tr>
				<th>Sl No.</th>
				<th>Task</th>
				<th>Image</th>
				<th>Edit  </th>
				<th>Delete  </th>
			</tr>
		</thead>
		<tbody>
			<?php
			//print_r($rec);
			$no = 1;
			$numItems = count($rec);
			$num2 = $numItems-1;
			$i = 0;
			echo $rec['total'];
			foreach($rec as $r){
				if( ++$i === $num2) {
				   break;
				}
				$no++;
				?>
				<tr>
					<td><?=$no;?></td>
					<td><?php echo $r['task']; ?></td>
					<td><img src="uploads/<?=$r['image'];?>" alt="Smiley face" height="100" width="100"></td>
					<td><a href="home.php?edit=<?=$r['id'];?>">Edit</a></td>
					<td><a href="home.php?delete=<?=$r['id'];?>">Delete</a></td>
				</tr>

			<?php
			}
			?>
		</tbody>
	</table>

	<?php for($x =1; $x <= $rec['pages']; $x++):?>
			<a href="?page=<?php echo $x; ?>&per-page=<?php echo $perPage; ?>"<?php if($page === $x) {echo 'class="selected"';}?>><?php echo $x; ?></a>
	<?php endfor; 
}

?>