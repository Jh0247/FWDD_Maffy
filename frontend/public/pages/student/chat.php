<?php
    include("../../../../backend/conn.php");
    include("../../../../backend/session.php");
    // i want to test
    #select chat data
    $chat = "SELECT * FROM chat";
    $chat_result = mysqli_query($con,$chat);

    #Get user information
    $user = "SELECT * FROM user WHERE user_id = '".$_SESSION["user_id"]."'";
    $user_result = mysqli_query($con,$user);
    $user_name = mysqli_fetch_assoc($user_result);
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
                    $user_lists = mysqli_query($con, "SELECT * FROM user");
                    while($user_list = mysqli_fetch_assoc($user_lists))
                    {
                      echo "<span class=\"nav-item\"><a href='?ToUser=" .$user_list['user_id']."'>".$user_list["username"]. "</a></span>";
                    }
                  ?>
                </a>
              </li>
            </ul>
          </div>
          <!--End of sidebar-->
        </div>

        <div class="first-container flex flex-col justify-center content-center bg-slate-500 w-screen h-screen min-h-[90%] pt-2.5 pb-2.5">
          <!--Big container-->
          <?php
            if(isset($_GET['ToUser'])){
              $username = mysqli_query($con,"SELECT * FROM user WHERE user_id = '".$_GET['ToUser']."'");
              $uName = mysqli_fetch_assoc($username);
              echo "<input type='text' value = '".$_GET['ToUser']."' hidden>";
              echo $uName['username'];
            }else{
              $userName = mysqli_query($con,"SELECT * FROM user");
              $uName = mysqli_fetch_assoc($username);
              echo "<input type='text' value = '".$_SESSION['ToUser']."' hidden>";
              echo $uName['username'];
            }
          ?>
          <div class="bg-red-100 flex flex-col w-screen h-auto min-h-[80%] border-solid border border-black rounded-2xl m-0 p-0.5 lg:p-2.5 gap-1 justify-between lg:w-9/12 lg:m-auto lg:bg-gray-500">
            <div class="flex flex-col self-start overflow-y-auto">
              
              <?php
                if(mysqli_num_rows($chat_result) == 0){
                  echo "<p>No Message Yet</P>";
                  //echo "<p>".$user_name['username']."</p>";
                }else{
                  echo "
                    <div class=\"message_container w-full h-auto flex flex-col md:flex-row lg:flex-row justify-between border border-solid rounded-2xl border-black bg-slate-300	p-1 lg:w-4/52\">
                      <div class=\"flex flex-row\">
                        <img src=\"./profile.jpg\" class=\"profile_img w-11 h-11 pr-1 m-auto justify-start rounded-full lg:w-14 lg:h-14 md:w-14 md:h-14\">
                        <p class=\"message_text md:text-lg md:pl-1 sm:text-base\"></p>
                      </div>
                    </div>
                    <div class=\"time_container flex basis-6/12 pl-1 md:justify-end lg:justify-end\">
                      <p class=\"time_text self-center md:text-lg lg:text-base\" id=\"displayTime\">Time</p>
                    </div>
                    ";
                }
              ?>
            </div>

            <div class="w-full h-12 border-t-2 border-black">
                <!--Message type box-->
                <form>
                  <input type="text" class="outline-none p-2 bg-transparent border-none w-7/12" placeholder="Type Your Message Here....." id="chat_message">
                  <button class="chatSendBtn send_chat">Send</button>
                </form>
                <!--end of message type box-->
              </div>

          </div>
        </div>

      </div>
      <!--end of content box-->
      </div>
  </div>

    <script type="text/javascript">
      var today = new Date();
      var day = today.getDay();
      var daylist = ["Sunday","Monday","Tuesday","Wednesday ","Thursday","Friday","Saturday"];
      var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
      var time = today.getHours() + ":" + today.getMinutes();
      
      document.getElementById("displayTime").innerHTML = time + ' ' + date;
    </script>
      <script src="./JavaScript/hamburger.js"></script>
      <script src="./JavaScript/nav_bar.js"></script>
      <script src="./JavaScript/chat.js"></script>
</body>
</html>