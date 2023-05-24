<?php
    include("../backend/conn.php");
    include("../backend/session.php");

    $sender = $_POST["sender_id"];
    $friend_list = $_POST["friend_list"];
    $output = "";

    // $chats = mysqli_query($con,"SELECT * FROM chat where (sender_id = '".$sender."' AND friend_list_id = '".$friend_list."') 
    //                             OR (sender_id = '".$friend_list."' AND friend_list_id = '".$sender."')");

    $chats = mysqli_query($con, 
      "SELECT chat.chat_content, chat.chat_datetime, chat.sender_id, user.user_image, user.username FROM chat 
      INNER JOIN friend_list ON friend_list.friend_list_id = chat.friend_list_id
      INNER JOIN user ON user.user_id = chat.sender_id
      WHERE chat.friend_list_id = ".$friend_list);
    while($chat = mysqli_fetch_assoc($chats)){
      if ($chat["sender_id"] == $sender) {
        $output .= '
          <div class="message_container w-full h-auto flex flex-col md:flex-row lg:flex-row justify-between p-1 lg:w-4/52">
            <div class="flex flex-row">
              <img src="'.$chat['user_image'].'" class="profile_img w-11 h-11 pr-1 m-auto justify-start rounded-full lg:w-14 lg:h-14 md:w-14 md:h-14">
              <p class="message_text md:text-lg md:pl-1 sm:text-base">'.$chat['chat_content'].'</p>
            </div>
          </div>
          <div class="time_container flex basis-6/12 pl-1 md:justify-end lg:justify-end">
            <p class="time_text self-center md:text-lg lg:text-base">'.$chat['chat_datetime'].'</p>
          </div>';
      }
      else
      {
        $output .= "
        <div class=\"message_container w-full h-auto flex flex-col md:flex-row lg:flex-row justify-between p-1 lg:w-4/52\">
          <div class=\"flex flex-row\">
            <img src=\"" . $chat['user_image'] . "\" class=\"profile_img w-11 h-11 pr-1 m-auto justify-start rounded-full lg:w-14 lg:h-14 md:w-14 md:h-14\">
            <p class=\"message_text md:text-lg md:pl-1 sm:text-base\">" . $chat['chat_content'] . "</p>
          </div>
        </div>
        <div class=\"time_container flex basis-6/12 pl-1 md:justify-end lg:justify-end\">
          <p class=\"time_text self-center md:text-lg lg:text-base\">" . $chat['chat_datetime'] . "</p>
        </div>
    ";
      }
    }
    echo $output;
?>