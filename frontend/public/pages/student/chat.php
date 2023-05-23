<?php
    include("../../../../backend/conn.php");
    include("../../../../backend/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../../../src/stylesheets/shared/nav_bar.css">
    <link rel="stylesheet" href="../../../src/stylesheets/student/siderbar.css">
    <link rel="stylesheet" href="../../../src/stylesheets/student/chat.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/873ab321fe.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
</head>
<body>
<?php include '../shared/navbar.php';?>
      <!--content box-->
      <div style="display: flex;flex-direction: row;margin-top:80px;">
        <div>
        <!--sidebar-->
        <div class="sidebar">
            <div class="top">
                <div class="logo">
                    <h1>All Course Assessment</h1>
                </div>
            </div>
            <ul>
              <li>
                <a href="#">
                  <i class="fa fa-book" aria-hidden="true" class="sidebar-b-i"></i>
                  <span class="nav-item">Course Assessment</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-book" aria-hidden="true" class="sidebar-b-i"></i>
                  <span class="nav-item">Course Assessment</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-book" aria-hidden="true" class="sidebar-b-i"></i>
                  <span class="nav-item">Course Assessment</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-book" aria-hidden="true" class="sidebar-b-i"></i>
                  <span class="nav-item">Course Assessment</span>
                </a>
              </li>
            </ul>
          </div>
          <!--End of sidebar-->
        </div>

        <div class="first-container flex flex-col justify-center content-center bg-slate-500 w-screen h-screen min-h-screen pt-2.5 pb-2.5">
            <!--Big container-->
            <div class="bg-red-100 flex flex-col w-screen h-auto min-h-full border-solid border border-black rounded-2xl m-0 p-0.5 lg:p-2.5 gap-1 justify-between lg:w-9/12 lg:m-auto lg:bg-gray-500">
              <div class="flex flex-col self-start overflow-y-scroll gap-1">

                <!--Message container-->
                <div class="message_container w-full h-auto flex flex-col md:flex-row lg:flex-row justify-between border border-solid rounded-2xl border-black bg-slate-300	p-1 lg:w-4/52">
                  <!--Message content-->
                  <div class="flex flex-row">
                    <!-- md:w-11 md:h-11 md:m-1 -->
                    <img src="./profile.jpg" class="profile_img w-11 h-11 pr-1 m-auto justify-start rounded-full lg:w-14 lg:h-14 md:w-14 md:h-14">
                    <!-- md:text-sm md:w-full -->
                    <p class="message_text md:text-lg md:pl-1 sm:text-base">Hello World Hello World Hello World Hello World Hello World Hello World Hello World Hello World Hello World Hello World Hello World Hello World</p>
                  </div>
                  <!--Time Container-->
                  <div class="time_container flex basis-6/12 pl-1 md:justify-end lg:justify-end">
                    <!-- md:text-sm -->
                    <p class="time_text self-center md:text-lg lg:text-base" id="displayTime">Time</p>
                  </div>
                  <!--End of time container-->
                </div>
                <!--end of messasge container-->

              </div>

              <div class="w-full h-12 border-t-2 border-black">
                <!--Message type box-->
                <form>
                  <input type="text" class="outline-none p-2 bg-transparent border-none w-7/12" placeholder="Type Your Message Here.....">
                  <!-- <button class="border-none outline-none bg-gray-700	p-1 cursor-pointer text-white	px-2.5 py-1.5 hover:bg-slate-100 hover:text-black hover:shadow-md">Send</button> -->
                  <button class="chatSendBtn">Send</button>
                </form>
                <!--end of message type box-->
              </div>
            </div>
      </div>
      <!--end of content box-->
    <script type="text/javascript">
      var today = new Date();
      var day = today.getDay();
      var daylist = ["Sunday","Monday","Tuesday","Wednesday ","Thursday","Friday","Saturday"];
      var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
      var time = today.getHours() + ":" + today.getMinutes();
      //var dateTime = date+' '+time;
      
      //document.getElementById("displayTime").innerHTML = time + '<br> ' + date + ' <br>' + daylist[day];
      document.getElementById("displayTime").innerHTML = time + ' ' + date;
    </script>
      <script src="./JavaScript/hamburger.js"></script>
      <script src="./JavaScript/nav_bar.js"></script>
</body>
</html>