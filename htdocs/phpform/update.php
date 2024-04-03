<?php
require 'database.php';

$message = '';

if (isset($_POST['username']) && isset($_POST['email']) && isset($_FILES['image'])) {
    // Update username, email, and image in database
    $username = $_POST['username'];
    $email = $_POST['email'];
    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];

    move_uploaded_file($image_temp, 'uploads/' . $image);

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE users set username = ?, email = ?, image = ? where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($username, $email, $image, $_POST['id']));
    Database::disconnect();

    $message = 'Successfully updated!';
}

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM users where id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($_GET['id']));
$data = $q->fetch(PDO::FETCH_ASSOC);
Database::disconnect();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Update</title>
</head>
<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3>Update</h3>
            </div>

            <form class="form-horizontal" action="update.php?id=<?php echo $data['id'];?>" method="post" enctype="multipart/form-data">
              <div class="control-group <?php echo !empty($message)?'error':'';?>">
                  <label class="control-label">Message:</label>
                  <div class="controls">
                      <span class="help-inline"><?php echo $message;?></span>
                  </div>
              </div>
              <div class="control-group">
                <label class="control-label">Username</label>
                <div class="controls">
                  <input type="text" name="username" class="form-control" value="<?php echo !empty($data['username'])?$data['username']:'';?>"  placeholder="Username">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Email</label>
                <div class="controls">
                  <input type="text" name="email" class="form-control" value="<?php echo !empty($data['email'])?$data['email']:'';?>"  placeholder="Email">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Image</label>
                <div class="controls">
                  <input type="file" name="image" class="form-control"  placeholder="Image">
                </div>
              </div>
              <div class="form-actions">
                  <button type="submit" class="btn btn-success">Update</button>
                  <a class="btn" href="index.php">Back</a>
              </div>
            </form>
        </div>
    </div> <!-- /container -->
</body>
</html>