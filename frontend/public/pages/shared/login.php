<?php
//Start session
if(!isset($_SESSION)) {
  session_start();
  // session_unset();
  // session_destroy();
}
else{
  if ($_SESSION['privilege'] == ""){
    $_SESSION['privilege'] = NULL;
  }
}

if (isset($_SESSION['privilege'])) {
  echo("<script>alert('You are already logged in!')</script>");
  if($_SESSION['privilege'] == "admin"){
    header('Location: ../admin/dashboard.php');
  }
  else if($_SESSION['privilege'] == "teacher"){
    header('Location: ../teacher/homepage.php');
  }
  else if ($_SESSION['privilege'] == "student"){
    header('Location: ../student/homepage.php');
  }
}

if (isset($_POST['signUpBtn'])) {
  //Connection to database
  include("../../../../backend/conn.php");

  $register = TRUE;
  //get and assign value
  $username = strtolower($_POST['username']);
  $email = $_POST['email'];
  $password = $_POST['password'];
  //Prepare privilege id
  $privilege = $_POST['type'];
  $privilege == "teacher" ? $privilege=2 : $privilege=3;

  //Provide img as default image
  $defaultImg = "../../images/default.jpg";
  $imageFileType = strtolower(pathinfo($defaultImg,PATHINFO_EXTENSION));
  //Encode image into base64
  $processedImg = base64_encode(file_get_contents($defaultImg));
  //create a format of blob image (base64)
  $image = 'data:image/'.$imageFileType.';base64,'.$processedImg;

  //Get all user data
  $validation_user_query = "SELECT * FROM user";
  $validation_user_query_run = mysqli_query($con, $validation_user_query);
  if (!$validation_user_query_run){
    die('Error validation query: ' . mysqli_error($con));
  }

  //validation process for unique username
  if(mysqli_num_rows($validation_user_query_run) > 0) {
    foreach($validation_user_query_run as $row)
    {
      // ("Form Validation in PHP - javatpoint", 2021);
      if($row['username'] == $username)
      {
        echo("<script>alert('Username already exists!')</script>");
        $register = FALSE; //turn false to stop register process
        break;
      }
    }
  }

  if ($privilege === 2) { //teacher
    $file = $_FILES['uploadedFile'];  

    $allowedFileType = array('jpg', 'jpeg', 'png');
    $validationFile = pathinfo($file['name'], PATHINFO_EXTENSION);

    if (!in_array($validationFile, $allowedFileType)) {
      echo("<script>alert('Invalid File Type. Only (.jpg .jpeg .png) allowed!')</script>");
      $register = FALSE; //turn false to stop register process
    }
  }

  if($register){
    if ($privilege === 2) { //teacher
      //Receive user upload img
      $userSupDoc = $_FILES['uploadedFile']['tmp_name'];
      if ($_FILES['uploadedFile']['size'] > 0){
        //get image type
        $supDocType = strtolower(pathinfo($userSupDoc,PATHINFO_EXTENSION));
        //encode image into base64
        $processedDoc = base64_encode(file_get_contents($userSupDoc));
        //set image content with type and base64
        $support_document = 'data:image/'.$supDocType.';base64,'.$processedDoc;
        $sql = "INSERT INTO user (privilege_id, username, password, user_image, user_email, user_desc, user_last_login, user_support_doc, user_active)
            VALUES ('$privilege', '$username', '$password', '$image', '$email', null, null, '$support_document', 0)";
        $result = mysqli_query($con, $sql);
        if ($result){
          echo("<script>alert('Admin will review your request in 2 working days. Please login after 48 hours.')</script>");
        }
        else{
          echo("Error description: " . mysqli_error($con));
        }
      }
    } elseif ($privilege === 3) { //student
      $sql = "INSERT INTO user (privilege_id, username, password, user_image, user_email, user_desc, user_last_login, user_support_doc, user_active)
            VALUES ('$privilege', '$username', '$password', '$image', '$email', null, null, null, 1)";
      $result = mysqli_query($con, $sql);
      if ($result){
        echo("<script>alert('You had successfully register')</script>");
      }
      else{
        echo("Error description: " . mysqli_error($con));
      }
    }
  }

  //Close connection of database
  mysqli_close($con);
}

if (isset($_POST['loginBtn'])) {
  //Connection to database
  include("../../../../backend/conn.php");

	// username and password sent from Form
	$username=mysqli_real_escape_string($con,$_POST['username']);
	$password=mysqli_real_escape_string($con,$_POST['password']);

  //Try to find is the user is exist or not
	$sql="SELECT * FROM user WHERE username='$username' and password='$password'";
  //If user exist
	if ($result=mysqli_query($con,$sql))  {
	  // Return the number of rows in result set
    $rownum=mysqli_num_rows($result);
	};

  //Store user data into variable
	while($row=mysqli_fetch_array($result)){
		$id = $row['user_id'];
    $privilege_id = $row['privilege_id'];
    $username = $row['username'];
    $desc = $row['user_desc'];
    $email = $row['user_email'];
	};


  if(mysqli_num_rows($result) > 0)
  {
    $privilege_sql="SELECT * FROM privilege WHERE privilege_id='$privilege_id'";
    $privilege_result=mysqli_query($con,$privilege_sql);

    while($privlege_row=mysqli_fetch_array($privilege_result)){
      $user_privilege = $privlege_row['user_privilege'];
    };
  }

  $_SESSION['privilege']= '';

  //Store user data into session
	if($rownum==1)  {
		$_SESSION['user_id']=$id;
    $_SESSION['privilege']=$user_privilege;
		$_SESSION['username']=$username;
    $_SESSION['desc']=$desc;
    $_SESSION['email']=$email;

    // Execute query to update user last login
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $now = date('Y-m-d H:i:s');
    $update_login_timestamp = mysqli_query($con, "UPDATE user SET user_last_login = '$now' WHERE user_id = $id");
    if (!$update_login_timestamp){
      die('Error validation query: ' . mysqli_error($con));
    }

    // mysqli_query($con, $update_login_timestamp);
    
    switch($user_privilege){
      case 'admin':
        echo("<script>window.location = '../admin/dashboard.php'</script>");
        break;
      case 'teacher':
        echo("<script>window.location = '../teacher/homepage.php'</script>");
        break;
      case 'student':
        echo("<script>window.location = '../student/homepage.php'</script>");
        break;
    }
	}
  //If user not exist
	else {
		echo "<script>alert('Your Login Details are invalid. Please try again');</script>";
	};

  //Close connection of database
  mysqli_close($con);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/shared/login.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Login - Maffy</title>
</head>

<body>
  <!-- <?php include '../shared/navbar.php';?> -->
  <div class="content">
    <div class="lgn-container">
      <div class="tab-group w-9/12 sm:w-8/12 lg:w-3/4">
        <div class="tab w-1/2">
          <a class="text-sm sm:text-base lg:text-lg" href="#signup">SignUp</a>
        </div>
        <div class="tab w-1/2">
          <a class="text-sm sm:text-base lg:text-lg" href="#login">Log In</a>
        </div>
      </div>
      <div class="tab-content">
        <!-- Sign up tab content -->
        <div id="signup" class = "ml-3">  
          <h1 class="title-txt">Sign up on Maffy</h1>
          <form method="post" enctype="multipart/form-data">
            <div class="form_group">
              <input type="email" class="form_field" name="email" placeholder="Email" required autofocus>
              <label for="email" class="form_label">Email</label>
            </div>
            <div class="form_group">
              <input type="text" class="form_field" name="username" placeholder="Username" required autofocus>
              <label for="username" class="form_label">Username</label>
            </div>
            <div class="form_group">
              <input type="password" class="form_field" name="password" placeholder="Password" required>
              <label for="password" class="form_label">Password</label>
            </div>
            <!-- Radio button to choose user type -->
            <div class="radio-group">
              <div class="w-1/2">
                <input type="radio" class="radio-btn" name="type" value="teacher">
                <a class="text-sm sm:text-base lg:text-lg">Teacher</a>
              </div>
              <div class="w-1/2">
                <input type="radio" class="radio-btn" name="type" value="student">
                <a class="text-sm sm:text-base lg:text-lg">Student</a>
              </div>
            </div>
            <!-- file upload for teacher -->
            <div class = "upload-container ml-1 mt-2">
              <div class = "mb-3">
                <a class="upload-txt">Please upload your certified education file (IMAGE) to sign up as a teacher.</a>
              </div>
              <input id="fileUpload" class="upload-button" type="file" name="uploadedFile">
            </div>
            <button type="submit" class="submitBtn" value="signup" name="signUpBtn"> Sign Up </button>
          </form>
        </div>
        
        <!-- Login tab content -->
        <div id="login" class = "ml-3">
          <h1 class="title-txt">Login To Maffy</h1>
          <form method="post" enctype="multipart/form-data">
            <div class="form_group">
              <input type="text" class="form_field" name="username" placeholder="Username" required autofocus>
              <label for="username" class="form_label">Username</label>
            </div>
    
            <div class="form_group">
              <input type="password" class="form_field" name="password" placeholder="Password" required>
              <label for="username" class="form_label">Password</label>
            </div>
            <button type="submit" class="submitBtn" value="Login" name="loginBtn"> Login </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    //==============================================================================
    // script on handling tab swapping for the login and signup
    $(document).ready(function() {
      // Add "active" class to "login" tab by default
      $('.tab a[href="#login"]').addClass('active');

      // Hide all tab contents except "login"
      $('.tab-content > div:not("#login")').hide();

      // When a tab is clicked, show its corresponding content and hide the others
      $('.tab a').on('click', function(e) {
        e.preventDefault();

        // Remove "active" class from all tabs
        $('.tab a').removeClass('active');

        // Add "active" class to clicked tab
        $(this).addClass('active');

        // Hide all tab contents except the one that matches the clicked tab
        $('.tab-content > div').hide();
        $($(this).attr('href')).show();
      });
    });

  //==============================================================================
  // function to add some animation on the login container
  // get container id
  const con=document.querySelector('.lgn-container');
  // when mouse in and out
  let isIn=true;
  let isOut=false;
  var span;

  con.addEventListener('mouseenter',(e)=>{
    if(isIn){
      let inX=e.clientX-e.target.offsetLeft;
      let inY=e.clientY-e.target.offsetTop;

      let el=document.createElement('span');
      el.style.left=inX+'px';
      el.style.top=inY+'px';
      con.appendChild(el);

      $('.lgn-container span').removeClass('out');
      $('.lgn-container span').addClass('in');

      span=document.querySelector('.lgn-container span');
      isIn=false;
      isOut=true;
    }
  });

  con.addEventListener('mouseleave',(e)=>{
    if(isOut){
      let outX=e.clientX-e.target.offsetLeft;
      let outY=e.clientY-e.target.offsetTop;

      $('.lgn-container span').removeClass('in');
      $('.lgn-container span').addClass('out');

      $('.out').css('left',outX+'px');
      $('.out').css('top',outY+'px');

      isOut=true;
      setTimeout(() => {
          con.removeChild(span);
          isIn=true;
      },500);
    }
  })
  //==============================================================================
  // function to hide and show the upload file container for teacher
  const radioButtons = document.querySelectorAll('input[type="radio"]');
  const uploadContainer = document.querySelector('.upload-container');

  uploadContainer.style.display = 'none'; // set display to none by default

  radioButtons.forEach((radio) => {
    radio.addEventListener('click', () => {
      if (radio.value === 'teacher') {
        uploadContainer.style.display = 'block';
      } else {
        uploadContainer.style.display = 'none';
      }
    });
  });
</script>
</body>
</html>