<?php
session_start();
if ($_SESSION['type'] !== "admin") {
  header("Location: ../index.php");
} else {
include_once("connection.php");
$target_dir = "../images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$dlong = nl2br($_POST['description_long']);
// Check if image file is a actual image or fake image
$sql="INSERT INTO `item` (`reference`, `name`, `value`,
`type`, `chassis`, `transmission`, `traction`, `description`, `description_long`, `stock`, `pic`) VALUES
(NULL, '".$_POST['name']."',
 '".$_POST['value']."',
 '".$_POST['type']."',
 '".$_POST['chassis']."',
 '".$_POST['transmission']."',
 '".$_POST['traction']."',
 '".$_POST['description']."',
 '".$dlong."',
 '".$_POST['stock']."',
 'images/".$_FILES['fileToUpload']['name']."');";
 var_dump($sql);
 var_dump($_POST);
  if ($result = $connection->query($sql)) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            echo "<br/><br/>";
            echo "Error uploading the image, check if the item was created properly.";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                header("Location: ../productcreator.php");
            } else {
                echo "Sorry, there was an error uploading your file.";
                echo "<br/><br/>";
                echo "Error uploading the image, check if the item was created properly.";
            }
        }

  } else {
    echo "error";
    echo "$sql<br/><br/>";
    echo "Check the length of both descriptions.";
  }
}
unset($connection);
 ?>
