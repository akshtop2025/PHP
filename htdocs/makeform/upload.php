<?php
$con = mysqli_connect("localhost", "root", "", "insert");
if (!$con) {
    die("Error: Could not connect to the database. " . mysqli_connect_error());
}

if (isset($_POST['submit']) && isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "images/" . $filename;

    if (move_uploaded_file($tempname, $folder)) {
        // $sql = "INSERT INTO images ('title','description',file) VALUES ('$title', '$description','$filename')";
        $sql= "INSERT INTO images (`title`, `description`, `file`) VALUES ('$title', '$description', '$filename')";



        if (mysqli_query($con, $sql)) {
            echo "<h2>File uploaded successfully</h2>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    } else {
        echo "There was an error moving the file";
    }
}




?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload Image</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img src="" alt="">
    <form action="#" method="POST" enctype="multipart/form-data">



    <div class="form-group">
        <label for="title">name</label>
        <input type="text" id="title" name="title" >
    </div>

    <div class="form-group">
        <label for="email">email</label>
        <input type="email" name="description" id="">
        <!-- <textarea name="" id="" cols="30" rows="10"></textarea> -->
    </div>
    <div class="form-control">
    <label for="image">Image:</label>
        <input type="file" name="image" id="image" class="form-control">
        <input type="submit" value="Submit" name="submit" class="btn btn-success">
    </div>
        
    </form>
    <?php
    
    $res = mysqli_query($con, "SELECT * FROM images");

while ($row = mysqli_fetch_assoc($res)) {
    echo '<div class="img-container >
    <table>
    <thead>this is data from database</thead>
    <tbody>
    <tr><td >name is:</td>
    <td >email:</td>
    <td ">profile pic</td>
    </tr>
    <tr>
    <td>' . $row['title'] . '</td>
    <td >' . $row['description'] . '</td>
    <td><img src="images/' . $row['file'] . '" alt="Uploaded Image" style="width: 20%; " /></td>
    </tr>
    </tbody>
    </table> </div>';
}

$sql = "DELETE FROM `images` WHERE `id` = $id";
$res = mysqli_query($con, $sql);
mysqli_close($con);    
    ?>
</body>
</html>
