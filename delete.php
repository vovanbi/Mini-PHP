<?php 
 
require_once './db/connection.php';

 $id = intval($_GET['id']);

 $sql = "DELETE FROM products WHERE id = $id";
 $result = $conn->query($sql);

 if($result==false)
 {
 	die('Could not delete  data' . mysql_error());
 }

  echo '<script language="javascriprt">';
  echo 'alert(Delete product sucess !)';
  echo '</script>';
  header('location: index.php');
 
 $conn->close();
 

?>