<?php
if (isset($_POST['estilo'])){
  echo $_POST['estilo'];
  $sql = "UPDATE `users` SET `theme` =
  '".$_POST['estilo']."' WHERE `users`.`nick` = '".$_SESSION["user"]."';";
  $result = $connection->query($sql);
} else if ($_SESSION['type'] == 'user' or $_SESSION['type'] == 'admin') {
  $sql="SELECT theme FROM users where `id` = '".$_SESSION['id']."'";
  $result = $connection->query($sql);
  $obj = $result->fetch_object();
  if ($obj->theme == '') {
    echo "index.css";
  } else {
  echo "$obj->theme";
}
} else if ($_SESSION['type'] == 'none') {
  echo "index.css";
}
?>
