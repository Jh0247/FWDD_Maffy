<?php
  // connection to database
  include("../../../../backend/conn.php");
  include("../../../../backend/session.php");

  $course_result = mysqli_query($con, "SELECT * FROM course WHERE course_status = 1");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/shared/view_list.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/775f0ea71b.js" crossorigin="anonymous"></script>
  <title>All course</title>
</head>
<body>
  <div class="home-cont">
    <?php include '../shared/navbar.php';?>
    <div class="home-arr">
      <div class="main-cont">
        <div class="row-cont title-cont">
          <h2 class = "title">Courses</h2>
        </div>
        <!-- search bar -->
        <div class="search-cont">
          <input id="search-bar" type="text" class="search__input" placeholder="Search something..">
          <span class="search__button">
            <i class="fa-solid fa-magnifying-glass"></i>
          </span>
        </div>
        <!-- list -->
        <div id="search-results" class="result-container">
          <!-- for friend list -->
          <?php
          if(mysqli_num_rows($course_result) > 0) {
            foreach($course_result as $data) {
              ?>
              <a href="../shared/course_page.php?userid=<?php echo $_SESSION['user_id']; ?>&courseid=<?php echo $data['course_id']; ?>" class="item-cont">
                <div class="left-details">  <!-- left content  -->
                  <!-- img cont  -->
                  <div class="md:mr-5">
                    <img src="<?=$data['course_image']?>" alt="profile pic" class="profile-img">
                  </div>
                  <!-- name and details -->
                  <div class="col-cont">
                    <h2 class="name-title"><?php echo $data['course_title']; ?></h2>
                    <h3 class="desc-title"><?php echo $data['course_desc']; ?></h3>
                  </div>
                </div>
                <!-- arrow -->
                <div class="btn-cont">
                  <span class="chat-btn">
                    <h2>Access</h2>
                    <i class="fa-solid fa-chevron-right"></i>
                  </span>
                </div>
              </a>
            <?php
            }
          } else{
            ?>
            <div class="no-friend-cont">
              Please wait for the teacher to upload some course assessment.
            </div>
            <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>  
<script>
  //get class and id
  const searchBar = document.getElementById("search-bar");
  const items = document.querySelectorAll(".item-cont");

  //add event listener
  searchBar.addEventListener("input", () => {
    //get search bar value
    const query = searchBar.value.trim().toLowerCase();

    items.forEach(item => {
      const name = item.querySelector("h2").textContent.trim().toLowerCase();
      const email = item.querySelector("h3").textContent.trim().toLowerCase();
      
      if (name.includes(query) || email.includes(query)) {
        item.style.display = "flex";
      } else {
        item.style.display = "none";
      }
    });
  });
</script>
</body>
</html>