<?php
    include("../backend/conn.php");
    include("../backend/session.php");

    $sender = $_POST["sender_id"];
    $assessment = $_POST["assessment_id"];
    $comment = $_POST["commentText"];

    $output = "";

    date_default_timezone_set('Asia/Kuala_Lumpur');
    $now = date('Y-m-d');

    $sql = "INSERT INTO comment (`assessment_id`,`user_id`, `comment_word`, `comment_date_posted`) VALUES ($assessment, '$sender' ,'$comment', '$now')";

    $result = mysqli_query($con, $sql);
    // if ($result){
    //   echo("<script>alert('SEND')</script>");
    // }
    // else{
    //   echo("Error description: " . mysqli_error($con));
    // }
?>