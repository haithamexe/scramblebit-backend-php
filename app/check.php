<?php

if(isset($_POST['id'])) {
  require '../db_connect.php';

  $id = $_POST['id'];

  if(empty($id)) {
    echo 'error';
  }else {
   
    $todo = $conn->prepare("SELECT id, checked FROM todos WHERE id=?");
    $todo->execute([$id]);
    $todo = $todo->fetch();
    $uId = $todo['id'];
    $checked = $todo['checked'];
    $uChecked = $checked ? 0 : 1;
    $res = $conn->query("UPDATE todos SET checked=$uChecked WHERE id=$uId");
    if($res) {
      echo $checked;
    }else {
      echo "error";
    }

    $conn = null;
    exit();
  } 
}else {
  header("Location: ../index.php?mess=error");
}