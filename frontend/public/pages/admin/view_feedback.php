<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/admin/view_feedback.css" />
  <title>Feedback</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/775f0ea71b.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="w-screen h-screen flex flex-row">
    <?php include '../admin/sidebar.php';?>
    <div class="w-full overflow-auto">
      
      <div class="flex flex-col h-fit mx-6 sm:mx-9 text-left">
        <div class="h-1/6 my-5 sm:my-8 ">
          <button onclick="history.back()" class="backbutton"><</button>
        </div> <!-- back button -->

        <div class="card">
          <div class="user-container">
            <p class="user my-2 ml-3">John Doe</p>
            <p class="email my-2 ml-3">john@gmail.com</p>
          </div>
          <div class="feedback" name="feedback">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
          labore et dolore magna aliqua.
          </div>
        </div>
      </div>
    </div>
  </div>


<script type="text/javascript" src="./javascript/sidebar.js"></script>
</body>
</html>