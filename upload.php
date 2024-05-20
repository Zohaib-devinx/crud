<?php  

//connect to the database

$servername = "localhost";
$username = "root";
$password = "";
$database  = "notes";


// connection of database
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
   die("Sorry failed to connect" . mysqli_connect_error());  
}


if (isset($_POST['submit'])) {
    $file_name = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = 'images/' .$file_name;
    
    
    $query = mysqli_query($conn, "insert into images (file) values ('$file_name')");

    if (move_uploaded_file($tempname, $folder)) {
        echo "<h2>File Upload Successfully!</h2>";
    }else{
        echo "<h2>File Upload not Successfully!</h2>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload image</title>
</head>

<body>

    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="image">
        <br><br>
        <button type="submit" name="submit">Submit</button>
        
    </form>
    <div>
        <?php
          $res = mysqli_query($conn , "select * from images");
          while ($row  = mysqli_fetch_assoc($res)) {

        ?>
        <img src="images/<?php echo $row['file']  ?>" alt="">
        <?php      }   ?>
    </div>

</body>

</html>