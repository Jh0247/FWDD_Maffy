<?php
    include("../backend/conn.php");
    include("../backend/session.php");

    $sender = $_POST["sender_id"];
    $friend_list = $_POST["friend_list"];
    $message = $_POST["message"];

    $output = "";

    date_default_timezone_set('Asia/Kuala_Lumpur');
    $now = date('Y-m-d H:i:s');

    $sql = "INSERT INTO chat (`friend_list_id`, `sender_id`, `chat_content`, `chat_datetime`) VALUES ($friend_list, '$sender', '$message', '$now')";

    $result = mysqli_query($con, $sql);
    if ($result){
      echo("<script>alert('SEND')</script>");
    }
    else{
      echo("Error description: " . mysqli_error($con));
    }
?>