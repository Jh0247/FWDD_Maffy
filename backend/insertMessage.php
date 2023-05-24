<?php
    // include("../backend/conn.php");
    // include("../backend/session.php");

    // echo("<script>alert('You were logged in!')</script>");
    // // $fromUser = $_POST["fromUser"];
    // // $friend = $_POST["friend"];
    
    // $friend_list = $_POST["friend_list"];
    // $message = $_POST["message"];

    // $output = "";

    // $sql = "INSERT INTO messages (fromUser, toUser, message) VALUE ('$fromUser','$friend','$message')";
    // $sql = "SELECT
    //     CASE
    //         WHEN first_user_id = $user_id THEN second_user_id
    //         ELSE first_user_id
    //     END AS second_user_id,
    //     CASE
    //         WHEN first_user_id = $user_id THEN first_user_id
    //         ELSE second_user_id
    //     END AS first_user_id,
    //     friend_status, friend_list_id, chat_content, chat_datetime
    //     FROM friend_list
    //     INNER JOIN chat ON chat.friend_list_id = friend.friend_list_id
    //     WHERE first_user_id = $user_id OR second_user_id = $user_id
    //     AND first_user_id = $friend_id OR second_user_id = $friend_id"

    // date_default_timezone_set('Asia/Kuala_Lumpur');
    // $now = date('Y-m-d H:i:s');

    // $sql = "INSERT INTO chat ('friend_list_id', 'chat_content', 'chat_datetime') VALUES ($friend_list, $message, $now)";

    // $result = mysqli_query($con, $sql);
    // if ($result){
    //   echo("<script>alert('SEND')</script>");
    // }
    // else{
    //   echo("Error description: " . mysqli_error($con));
    // }

    // if($con -> query($sql)){
    //     $output .= "";
    // }else{
    //     $output .= "Error, Please Try Again.";
    // }

    // echo $output;
?>
<?php
    include("../backend/conn.php");
    include("../backend/session.php");

    echo("<script>alert('You were logged in!')</script>");

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