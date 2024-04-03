<?php
// Functions for database connection
function connectToDatabase($servername, $username, $password, $database) {
    $conn = mysqli_connect($servername, $username, $password, $database);
    if (!$conn) {
        die("Sorry we failed to connect: " . mysqli_connect_error());
    }
    return $conn;
}

// Inserting image into database and uploading to folder
function uploadAndInsertImage($conn) {
    if (isset($_POST['submit'])) {
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $filename = $_FILES["image"]["name"];
            $tempname = $_FILES["image"]["tmp_name"];
            $folder = "images/" . $filename;

            // Move uploaded file to specified folder
            if (move_uploaded_file($tempname, $folder)) {
                // Insert file name into database
                $sql = "INSERT INTO images (file) VALUES ('$filename')";
                if (mysqli_query($conn, $sql)) {
                    echo "<h2>File uploaded successfully</h2>";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "There was an error moving the file";
            }
        } else {
            echo "No file chosen";
        }
    }
}

// Displaying uploaded images
function displayImages($conn) {
    $res = mysqli_query($conn, "SELECT * FROM images");
    while ($row = mysqli_fetch_assoc($res)) {
        echo '<div class="img-container"><img src="images/' . $row['file'] . '" alt="Uploaded Image"  /><div/>';
    }
}

// Main code
$servername = "localhost";
$username = "root";
$password = "";
$database = "insert";

$conn = connectToDatabase($servername, $username, $password, $database);

uploadAndInsertImage($conn);

// CRUD operations for notes
$insert = false;
$update = false;
$delete = false;

if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `image` WHERE `sno` = $sno";
    $result = mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['snoEdit'])) {
        // Update the record
        $sno = $_POST["snoEdit"];
        $title = $_POST["titleEdit"];
        $description = $_POST["descriptionEdit"];
        
        $sql = "UPDATE `image` SET `title` = '$title' , `description` = '$description' WHERE `image`.`id` = $sno";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $update = true;
        } else {
            echo "We could not update the record successfully";
        }
    } else {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $image = $_POST["image"];
        
        $sql = "INSERT INTO `image` (`title`, `description`) VALUES ('$title', '$description')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $insert = true;
        } else {
            echo "The record was not inserted successfully because of this error ---> " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iNotes - Notes taking made easy</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><img src="/crud/logo.svg" height="28px" alt=""></a>
        <!-- Navbar content -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>

      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>

    </nav>

    <?php
    if ($insert) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your note has been inserted successfully
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>×</span>
        </button>
    </div>";
    }

    if ($delete) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your note has been deleted successfully
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>×</span>
        </button>
    </div>";
    }

    if ($update) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your note has been updated successfully
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>×</span>
        </button>
    </div>";
    }
    ?>

    <div class="container my-4">
        <!-- Form for adding a note -->
        <form action="#" method="POST" enctype="multipart/form-data">
        <div class="form-group">
        <label for="title">Note Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
      </div>

      <div class="form-group">
        <label for="desc">Note Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>
      <div class="form-group">
      <label for="image">Image:</label>
      <input type="file" name="image" id="image" class="form-control">
      <!-- <input type="submit" value="Submit" name="submit" class="btn btn-success"> -->
      </div>
      <button type="submit" class="btn btn-primary" name="submit">submit</button>
    </form>
    </div>

    <div class="container my-4">
        <!-- Table for displaying notes -->
        <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">photo</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <!-- Modal content -->
        <tbody>
        <?php 
        //   $sql = "SELECT * FROM `image`";
        //   $result = mysqli_query($conn, $sql);
        //   $ = 0;
        //   while($row = mysqli_fetch_assoc($result)){
        //     $sno = $sno + 1;
        //     echo "<tr>
        //     <th scope='row'>". $sno . "</th>
        //     <td>". $row['title'] . "</td>
        //     <td>". $row['description'] . "</td>
        //     <td>". $row['image'] . "</td>
        //     <td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button>  </td>
        //   </tr>";
        // } 
         
    // $sql = "SELECT * FROM `image`";

    // $result = mysqli_query($conn, $sql);
    // $sno = 0; // Initialize $sno
    // while($row = mysqli_fetch_assoc($result)){
    //     $sno++; // Increment $sno
    //     echo "<tr>
    //         <th scope='row'>'. $sno . '</th>
    //         <td>". $row['title'] . "</td>
    //         <td>". $row['description'] . "</td>
    //         <td>". $row['image'] . "</td>
    //         <td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button>  </td>
    //     </tr>";
    // }
     
    $sql = "SELECT * FROM `image`";
    $result = mysqli_query($conn, $sql);
    // $sno = 0; // Initialize $sno
    while ($row = mysqli_fetch_assoc($result)) {
        $sno++; // Increment $sno
        echo "<tr>
                <th scope='row'>" . $sno . "</th>
                <td>" . $row['title'] . "</td>
                <td>" . $row['description'] . "</td>
                <td>" . $row['image'] . "</td>
                <td> <button class='edit btn btn-sm btn-primary' id='" . $row['sno'] . "'>Edit</button> <button class='delete btn btn-sm btn-primary' id='d" . $row['sno'] . "'>Delete</button>  </td>
            </tr>";
    }
              

?>

      </tbody>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            // Edit button logic
        //     element.addEventListener("click", (e) => {
        // console.log("edit ");
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        });

        deletes = document.getElementsByClassName('delete');
        // Array.from(deletes).forEach((element) => {
            // Delete button logic
    //         Array.from(deletes).forEach((element) => {
    //   element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/crud/index.php?delete=${sno}`;
        });
    </script>
</body>
</html>
