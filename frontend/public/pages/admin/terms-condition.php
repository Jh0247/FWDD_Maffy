<?php
  // connection to database
  include("../../../../backend/conn.php");
  include("../../../../backend/session.php");
  if ($_SESSION['privilege'] == 'teacher'){
    echo("<script>alert('You do not have the privilege to access this page.')</script>");
    echo("<script>window.location = '../teacher/homepage.php'</script>");
  }
  else if ($_SESSION['privilege'] == 'student'){
    echo("<script>alert('You do not have the privilege to access this page.')</script>");
    echo("<script>window.location = '../student/homepage.php'</script>");
  }
  //Close connection of database
  mysqli_close($con);

$file_path = "../../term_condition/terms_condition.txt";
$term_contents = file_get_contents($file_path);

if(isset($_POST['condition'])){
  $file_open = fopen("../../term_condition/terms_condition.txt","w+"); //to add the contents to file
  fwrite($file_open, $_POST['condition']);
  fclose($file_open);
  header("Location: ".$_SERVER['PHP_SELF']);
  exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/admin/terms-condition.css" />
  <title>Term & Condition</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/775f0ea71b.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="w-screen h-screen flex flex-row">
    <?php include '../admin/sidebar.php';?>
    <div class="w-full overflow-auto">
      <div class="flex flex-col h-fit mx-6 sm:mx-9 text-left">
        <p class="term h-2/6 my-4 md:my-11 ml-3">Term & Condition</p>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
          <textarea name="condition" id="myTextarea" class="condition"><?php
            echo $term_contents;
          ?></textarea>
          <button name="" id="updateBtn" class="update-button hidden">Submit
            <div class="icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"></path><path fill="currentColor" d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"></path></svg>
            </div>
          </button>
        </form>
      </div>
    </div>
  </div>
<script type="text/javascript" src="./javascript/sidebar.js"></script>
<script>
  var change = document.getElementById("myTextarea");
  change.addEventListener("input", showBtn);
  // show the submit button
  function showBtn() {
    document.getElementById('updateBtn').classList.remove("hidden");
  }
</script>
</body>
</html>