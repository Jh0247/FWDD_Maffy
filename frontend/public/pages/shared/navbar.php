<?php
    // connection to database
    include("../../../../backend/conn.php");

    $current_page_url = basename($_SERVER['PHP_SELF']);
    $desired_page_url = "login.php";

    $current_page = basename($_SERVER['PHP_SELF']);
    
    $user_privilege = 0;
    
    if(isset($_SESSION['user_id'])) {
        // Retrieve user information from database
        $query = mysqli_query($con, "SELECT * FROM user WHERE user_id = $_SESSION[user_id]");
        $user = mysqli_fetch_array($query);
        $user_privilege = $user['privilege_id'];
    };
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../src/stylesheets/shared/nav_bar.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Nav Bar</title>
</head>

<body>
    <nav>
        <?php
            if($user_privilege == '2'){
                // teacher nav bar
                echo('
                <div class="nav-left">
                    <div class="logo">
                        <a href="../teacher/homepage.php"><img class="logo-image" src="../../../public/images/Maffy.png" alt="Website Icon"></a>
                    </div>
                </div>
                <div class="nav-right">
                    <ul class="nav-links">
                        <li><a class="btn active" href="../shared/view_all_course.php">Courses</a></li>
                        <li><a class="btn" href="../teacher/add_course.php?currentfile=">Add Course</a></li>
                        <li><a class="btn" href="../shared/term-condition.php">Term & Condition</a></li>
                        <div class="profile-res">
                            <li><a class="btn my-profile-btn" href="#">My Profile</a></li>
                            <div class="profile-dropdown_links">
                                <li><a href="../shared/user_profile.php">Profile</a></li>
                                <li><a href="../shared/feedback.php">Feedback</a></li>
                                <li><a href="../../../../backend/logout.php">Logout</a></li>
                            </div>
                        </div>
                        <li>
                            <div class="profile">
                                <img src="../../images/user_profile.png" alt="Profile Icon" id="profile-icon">
                                <div class="profile-dropdown" id="profile-dropdown">
                                    <a href="../shared/user_profile.php">Profile</a>
                                    <a href="../shared/feedback.php">Feedback</a>
                                    <a href="../../../../backend/logout.php">Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div>
                        <button class="nav-toggle" style="position:relative; width:100%; justify-content:flex-end;">
                            <div class="bar">Menu</div>
                        </button>
                    </div>
                </div>
                ');
            }elseif($user_privilege == '3') {
                // student nav bar
                echo('
                <div class="nav-left">
                    <div class="logo">
                        <a href="../student/homepage.php"><img class="logo-image" src="../../../public/images/Maffy.png" alt="Website Icon"></a>
                    </div>
                </div>
                <div class="nav-right">
                    <ul class="nav-links">
                        <li><a class="btn" href="../shared/view_all_course.php">Courses</a></li>
                        <li><a class="btn" href="../student/view_friend.php">Friend</a></li>
                        <li><a class="btn" href="../student/chat.php">Chat</a></li>
                        <li><a class="btn" href="../shared/term-condition.php">Term & Condition</a></li>
                        <div class="profile-res">
                            <li><a class="btn my-profile-btn" href="#">My Profile</a></li>
                            <div class="profile-dropdown_links">
                                <li><a href="../../pages/shared/user_profile.php">Profile</a></li>
                                <li><a href="../shared/feedback.php">Feedback</a></li>
                                <li><a href="../../../../backend/logout.php">Logout</a></li>
                            </div>
                        </div>
    
                        <li>
                            <div class="profile">
                                <img src="../../images/user_profile.png" alt="Profile Icon" id="profile-icon">
                                <div class="profile-dropdown" id="profile-dropdown">
                                    <a href="../../pages/shared/user_profile.php">Profile</a>
                                    <a href="../shared/feedback.php">Feedback</a>
                                    <a href="../../../../backend/logout.php">Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div>
                        <button class="nav-toggle">
                            <div class="bar">Menu</div>
                        </button>
                    </div>
                </div>
                ');
            }else if($user_privilege == '0' and $current_page_url === $desired_page_url){
                // login nav bar
                echo('
                <div class="nav-left">
                    <div class="logo">
                        <a href="home.php"><img class="logo-image" src="../../../public/images/Maffy.png" alt="Website Icon"></a>
                    </div>
                </div>
                ');
            }elseif($user_privilege == '0'){
                // guest nav bar
                echo('
                <div class="nav-left">
                    <div class="logo">
                        <a href="home.php"><img class="logo-image" src="../../../public/images/Maffy.png" alt="Website Icon"></a>
                    </div>
                </div>
                <div class="nav-right">
                    <ul class="nav-links">
                        <li><a class="btn active" href="#about-us">About Us</a></li>
                        <li><a class="btn" href="#course">Course</a></li>
                        <li><a class="btn" href="#faq">FAQS</a></li>
                        <li><a class="btn" href="#" onclick=\'navigateToPageT_C("../shared/term-condition.php")\'>Terms & Conditions</a></li>
                        <div class="login-resgister-res">
                            <li><a class="btn" href="#" onclick=\'navigateToPage("../../pages/shared/login.php")\'>Login</a></li>
                        </div>
    
                        <li>
                            <div class="login-register-toggle">
                                <button id="login-btn" onclick="location.href=\'login.php\'">Login</button>
                            </div>
                        </li>
    
                    </ul>
                    <div>
                        <button class="nav-toggle">
                            <div class="bar">Menu</div>
                        </button>
                    </div>
                </div>
                ');
            };
        ?>
    </nav>

    <script>
    // login page navigation
    function navigateToPage(url) {
        window.location.href = url;
    }

    function navigateToPageT_C(url) {
        window.location.href = url;
    }

    // menu responsive
    const navToggle = document.querySelector('.nav-toggle');
    const navLinks = document.querySelector('.nav-links');
    const profileToggle_menu = document.querySelector('.my-profile-btn');
    const profileDropdownList_menu = document.querySelector('.profile-dropdown_links');

    navToggle.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        navToggle.classList.toggle('active');

        if (profileDropdownList_menu.classList.contains('active')) {
            profileDropdownList_menu.classList.remove('active');
            profileDropdownList_menu.classList.add('inactive');
        }
    });

    // my-profile
    const profileToggle = document.querySelector('.profile-res');
    const profileDropdownList = document.querySelector('.profile-dropdown_links');

    profileToggle.addEventListener('click', () => {
        profileToggle.classList.toggle('active');
        profileDropdownList.classList.toggle('active');
    });

    // profile dropdown list
    const profileIcon = document.getElementById("profile-icon");
    const profileDropdown = document.getElementById("profile-dropdown");

    profileIcon.addEventListener("click", () => {
        if (profileDropdown.style.display === "block") {
            profileDropdown.style.display = "none";
        } else {
            profileDropdown.style.display = "block";
        }
    });
    </script>
</body>

</html>