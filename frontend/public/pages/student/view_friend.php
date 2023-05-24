<?php
  // connection to database
  include("../../../../backend/conn.php");
  include("../../../../backend/session.php");

  $user_id = $_SESSION['user_id'];
  $friend_result = mysqli_query($con, 
    "SELECT
    CASE
        WHEN first_user_id = $user_id THEN second_user_id
        ELSE first_user_id
    END AS second_user_id,
    CASE
        WHEN first_user_id = $user_id THEN first_user_id
        ELSE second_user_id
    END AS first_user_id,
    friend_status, user.user_image, user.username, user.user_email
    FROM friend_list
    INNER JOIN user ON user.user_id =(
    CASE
      WHEN friend_list.second_user_id != $user_id THEN friend_list.second_user_id
      ELSE friend_list.first_user_id
    END)
    WHERE (first_user_id = $user_id OR second_user_id = $user_id)");
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
  <title>Friend List</title>
</head>
<body>
  <div class="home-cont">
    <?php include '../shared/navbar.php';?>
    <div class="home-arr">
      <div class="main-cont">
        <div class="row-cont title-cont">
          <h2 class = "title">Friend</h2>
          <div class="btn-container">
            <a href="../student/friend_request.php" class="friend-btn"><h2>Friend Request</h2></a>
            <a href="../student/friend_request.php" class="friend-icon"><i class="fa-solid fa-users"></i></a>
          </div>
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
          if(mysqli_num_rows($friend_result) > 0) {
            foreach($friend_result as $data) {
              ?>
              <div class="item-cont">
                <a href="../shared/user_profile.php?id=<?php echo $data['second_user_id']; ?>" class="left-details">  <!-- left content  -->
                  <!-- img cont  -->
                  <div class="md:mr-5">
                    <img src="<?=$data['user_image']?>" alt="profile pic" class="profile-img">
                  </div>
                  <!-- name and details -->
                  <div class="col-cont">
                    <h2 class="name-title"><?php echo $data['username']; ?></h2>
                    <h3 class="desc-title"><?php echo $data['user_email']; ?></h3>
                  </div>
                </a>
                <!-- chat -->
                <div class="btn-cont">
                  <a href="../student/chat.php?friend=<?php echo $data['second_user_id']; ?>" class="chat-btn">
                    <h2>Chat</h2>
                    <i class="fa-solid fa-comments chat-icon"></i>
                  </a>
                </div>
              </div>
            <?php
            }
          } else{
            ?>
            <div class="no-friend-cont">
              Find a friend and start chatting.
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