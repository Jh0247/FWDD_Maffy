<?php
    include("../../../../backend/conn.php");
    include("../../../../backend/session.php");
    #select chat data
    $chat = "SELECT * FROM chat";
    $chat_result = mysqli_query($con,$chat);

    #Get user information
    $users = mysqli_query($con,"SELECT * FROM user WHERE user_id = '".$_SESSION["user_id"]."'");
    $user = mysqli_fetch_assoc($users);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../../../src/stylesheets/student/siderbar.css">
    <link rel="stylesheet" href="../../../src/stylesheets/student/chat.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://kit.fontawesome.com/873ab321fe.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
</head>
<body>
  <div class="home-cont">
    <?php include '../shared/navbar.php';?>
    <div class="home-arr">
      <!--content box-->
      <div style="display: flex;flex-direction: row;">
        <div>
        <!--sidebar-->
        <div class="sidebar">
            <div class="top">
                <div class="logo">
                    <h1>All Friends</h1>
                </div>
            </div>
            <ul>
              <li>
                <a href="#">
                <i class="fa fa-user" aria-hidden="true"></i>
                  <?php
                  // get the user friend list
                    $user_lists = mysqli_query($con, 
                    "SELECT
                      CASE
                          WHEN first_user_id = 3 THEN second_user_id
                          ELSE first_user_id
                      END AS second_user_id,
                      CASE
                          WHEN first_user_id = 3 THEN first_user_id
                          ELSE second_user_id
                      END AS first_user_id,
                      friend_status, user.username
                      FROM friend_list
                      INNER JOIN user ON user.user_id = friend_list.second_user_id
                      WHERE first_user_id = 3 OR second_user_id =3
                      AND friend_status = 1;");
                    while($user_list = mysqli_fetch_assoc($user_lists))
                    {
                      echo "<span class=\"nav-item\"><a href='?friend=" .$user_list['second_user_id']."'>".$user_list["username"]. "</a></span>";
                    }
                  ?>
                </a>
              </li>
            </ul>
          </div>
          <!--End of sidebar-->
        </div>

        <input type="text" id="fromUser" value=<?php echo $user["user_id"]; ?> hidden />

        <div class="first-container flex flex-col justify-center content-center bg-slate-500 w-screen h-screen min-h-[90%] pt-2.5 pb-2.5">
          <!--Big container-->
          <?php
            if(isset($_GET['friend'])){
              $username = mysqli_query($con,"SELECT * FROM user WHERE user_id = '".$_GET['friend']."'");
              $uName = mysqli_fetch_assoc($username);
              echo "<input type='text' value = ".$_GET['friend']." id='friend' hidden/>";
              echo $uName['username'];
            }else{
              $userName = mysqli_query($con,"SELECT * FROM user");
              $uName = mysqli_fetch_assoc($userName);
              $_SESSION["friend"] = $uName["user_id"];
              echo "<input type='text' value = ".$_SESSION['friend']." id='friend' hidden/>";
              echo $uName['username'];
            }
          ?>
          <div id="chat-content" class="bg-red-100 flex flex-col w-screen h-auto min-h-[80%] border-solid border border-black rounded-2xl m-0 p-0.5 lg:p-2.5 gap-1 justify-between lg:w-9/12 lg:m-auto lg:bg-gray-500">
            <div class="flex flex-col self-start overflow-y-auto">
              <?php                  
                if(mysqli_num_rows($chat_result) == 0){
                  ?>
                  <p>Send a message to your friend..</P>
                  <?php
                }else{
                  if(isset($_GET['friend'])){
                    // php to get the friend list id
                    $get_friend_id_sql = mysqli_query($con, "SELECT *
                      FROM friend_list
                      WHERE (first_user_id = ".$_SESSION['user_id']." AND second_user_id = ".$_GET['friend'].")
                        OR (first_user_id = ".$_GET['friend']." AND second_user_id = ".$_SESSION['user_id'].")");

                    $friend_id_result = mysqli_fetch_array($get_friend_id_sql);
                    
                    $chats = mysqli_query($con, 
                      "SELECT chat.chat_content, chat.chat_datetime, user.user_image, user.username FROM chat 
                      INNER JOIN friend_list ON friend_list.friend_list_id = chat.friend_list_id
                      INNER JOIN user ON user.user_id = chat.sender_id
                      WHERE chat.friend_list_id = ".$friend_id_result['friend_list_id']);

                    if(mysqli_num_rows($chats) > 0)
                    {
                      foreach($chats as $chat_data) // Run SQL query
                      {
                    ?>

                    <div class="message_container w-full h-auto flex flex-col md:flex-row lg:flex-row justify-between border border-solid rounded-2xl border-black bg-slate-300 p-1 lg:w-4/52">
                      <div class="flex flex-row">
                        <img src="<?=$chat_data['user_image']?>" class="profile_img w-11 h-11 pr-1 m-auto justify-start rounded-full lg:w-14 lg:h-14 md:w-14 md:h-14">
                        <p class="message_text md:text-lg md:pl-1 sm:text-base"><?php echo $chat_data['chat_content']; ?></p>
                      </div>
                    </div>
                    <div class="time_container flex basis-6/12 pl-1 md:justify-end lg:justify-end">
                      <p class="time_text self-center md:text-lg lg:text-base"><?php echo $chat_data['chat_datetime']; ?></p>
                    </div>
                    <?php
                      }
                    }
                  }
                }
              ?>
            </div>
            <!-- send message container -->
            <div class="w-full h-12 border-t-2 border-black">
                <!--Message type box-->
                <?php
                  // to get friend id
                  if(isset($_GET['friend'])){
                    $get_friend_id_sql = mysqli_query($con, "SELECT *
                    FROM friend_list
                    WHERE (first_user_id = ".$_SESSION['user_id']." AND second_user_id = ".$_GET['friend'].")
                      OR (first_user_id = ".$_GET['friend']." AND second_user_id = ".$_SESSION['user_id'].")");

                    $friend_id_result = mysqli_fetch_array($get_friend_id_sql);
                ?>
                  <input type="text" id="message" class="outline-none p-2 bg-transparent border-none w-7/12" placeholder="Type Your Message Here....." id="chat_message">
                  <span class="chatSendBtn" id="send">Send</span>
                  <?php
                  } else {
                    ?>
                    <input type="text" class="outline-none p-2 bg-transparent border-none w-7/12" placeholder="Type Your Message Here....." id="chat_message">
                    <?php
                  }
                  ?>
                <!--end of message type box-->
              </div>

          </div>
        </div>

      </div><!--end of content box-->
    </div>
  </div>

  <script>
    // when click on the send button
    $(document).ready(function() {
      $("#send").on("click", function() {
        // assign value
        var friend_list = "<?php echo $friend_id_result['friend_list_id']; ?>";
        var message = $("#message").val();

        console.log("friend_list:", friend_list);
        console.log("message:", message);

        // pass to insert message
        $.ajax({
          url: "../../../../backend/insertMessage.php",
          method: "POST",
          data: {
            sender_id: "<?php echo $_SESSION['user_id']; ?>",
            friend_list: friend_list,
            message: message
          },
          dataType: "text",
          success: function(data) {
            $("#message").val("");
          }
        });
      });
    });
  </script>
  <script src="./JavaScript/hamburger.js"></script>
  <script src="./JavaScript/nav_bar.js"></script>
      
</body>
</html>