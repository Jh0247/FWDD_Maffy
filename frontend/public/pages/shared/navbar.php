<?php
    // connection to database
    include("../../../../backend/conn.php");

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
    <title>Nav Bar</title>

</head>

<body>

    <nav>
        <div class="nav-left">
            <div class="logo">
                <a href="#"><img class="logo-image" src="../../../public/images/Maffy.png" alt="Website Icon"></a>
            </div>
        </div>
        <?php
            if($user_privilege == '2'){
                echo('
                <!-- teacher nav bar -->
                <div class="nav-right">
                    <ul class="nav-links">
                        <li><a class="btn active" href="homepage.php">My Courses</a></li>
                        <li><a class="btn" href="add_course.php">Add Course</a></li>
                        <div class="profile-res">
                            <li><a class="btn my-profile-btn" href="#">My Profile</a></li>
                        </div>
                        <div class="profile-dropdown_links">
                            <li><a href="user_profile.php">Profile</a></li>
                            <li><a href="#" id="edit-password-btn">Edit Password</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </div>
    
                        <li>
                            <div class="profile">
                                <img src="../../images/user_profile.png" alt="Profile Icon" id="profile-icon">
                                <div class="profile-dropdown" id="profile-dropdown">
                                    <a href="user_profile.php">Profile</a>
                                    <a href="#" id="edit-password-btn">Edit Password</a>
                                    <a href="logout.php">Logout</a>
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
                echo('
                    <!-- student nav bar -->
                    <div class="nav-right">
                        <ul class="nav-links">
                            <li><a class="btn" href="#">Home</a></li>
                            <li><a class="btn" href="#">Course Assessment</a></li>
                            <li><a class="btn" href="#">Friend</a></li>
                            <div class="profile-res">
                                <li><a class="btn my-profile-btn" href="#">My Profile</a></li>
                            </div>
                            <div class="profile-dropdown_links">
                                <li><a href="#">Profile</a></li>
                                <li><a href="#" id="edit-password-btn">Edit Password</a></li>
                                <li><a href="#">Logout</a></li>
                            </div>
        
                            <li>
                                <div class="profile">
                                    <img src="../../images/user_profile.png" alt="Profile Icon" id="profile-icon">
                                    <div class="profile-dropdown" id="profile-dropdown">
                                        <a href="#">Profile</a>
                                        <a href="#" id="edit-password-btn">Edit Password</a>
                                        <a href="#">Logout</a>
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
            }else{
                echo('
                    <!-- guest nav bar -->
                    <div class="nav-right">
                        <ul class="nav-links">
                            <li><a class="btn active" href="#">About Us</a></li>
                            <li><a class="btn" href="#">Course</a></li>
                            <li><a class="btn" href="#">FAQS</a></li>
                            <div class="login-resgister-res">
                                <li><a class="btn" href="#">Login</a></li>
                                <li><a class="btn" href="#">Register</a></li>
                            </div>
        
                            <li>
                                <div class="login-register-toggle">
                                    <button id="login-btn" onclick="location.href=\'#\'">Login</button>
                                    <button id="register-btn" onclick="location.href=\'#\'">Register</button>
                                </div>
                            </li>
        
                        </ul>
                        <div id="profile-icon" style="padding: 60px 60px 88px 0px;">
                            <button class="nav-toggle">
                                <div class="bar">Menu</div>
                            </button>
                        </div>
                    </div>
                ');
            }
        ?>

    </nav>
    <!-- pop out edit password container -->
    <form id="form">
        <div class="pass-popout-container">
            <div id="password-popup">
                <h2>Edit Password</h2>
                <label for="current-password">Current Password:</label>
                <input type="password" id="current-password">
                <label for="new-password">New Password:</label>
                <input type="password" id="new-password">
                <label for="confirm-password">Confirm New Password:</label>
                <input type="password" id="confirm-password">
                <div class="button-row">
                    <button id="save-password-btn">Save</button>
                    <button id="cancel-password-btn">Cancel</button>
                </div>
            </div>
        </div>
    </form>

    <script>
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

    // Pop out edit password container
    const editPasswordBtn = document.getElementById('edit-password-btn');
    const passwordPopup = document.getElementById('password-popup');
    const savePasswordBtn = document.getElementById('save-password-btn');
    const cancelPasswordBtn = document.getElementById('cancel-password-btn');

    editPasswordBtn.addEventListener('click', () => {
        navLinks.classList.remove('active');
        navLinks.classList.add('inactive');
        navToggle.classList.remove('active');
        navToggle.classList.add('inactive');
        if (profileDropdownList_menu.classList.contains('active')) {
            profileDropdownList_menu.classList.remove('active');
            profileDropdownList_menu.classList.add('inactive');
        }
    });

    editPasswordBtn.addEventListener('click', () => {
        passwordPopup.style.display = 'block';
    });

    cancelPasswordBtn.addEventListener('click', () => {
        passwordPopup.style.display = 'none';
    });

    savePasswordBtn.addEventListener('click', () => {
        passwordPopup.style.display = 'none';
    });
    </script>
</body>

</html>