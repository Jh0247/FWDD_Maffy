<?php
    // connection to database
    include("../../../../backend/conn.php");
    include("../../../../backend/session.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../src/stylesheets/shared/nav_bar.css">
    <link rel="stylesheet" href="../../../src/stylesheets/teacher/homepage.css">
    <title>Homepage</title>

</head>

<body>
    <?php include '../shared/navbar.php';?>
    <!-- Trend Courses -->
    <h2 class="topic">Trend Courses</h2>
    <div class="big-container">
        <div class="container">
            <div class="image">
                <img src="../../images/technology.png" alt="Course 1">
            </div>
            <div class="content">
                <h2>Course 1</h2>
                <button class="course-btn" onclick="location.href='course_page.php'"> View Course
                    <svg viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" height="20" width="20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"
                            fill-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="container">
            <div class="image">
                <img src="../../images/technology.png" alt="Course 2">
            </div>
            <div class="content">
                <h2>Course 2</h2>
                <button class="course-btn" onclick="location.href='course_page.html'"> View Course
                    <svg viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" height="20" width="20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"
                            fill-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="container">
            <div class="image">
                <img src="../../images/technology.png" alt="Course 3">
            </div>
            <div class="content">
                <h2>Course 3</h2>
                <button class="course-btn" onclick="location.href='course_page.html'"> View Course
                    <svg viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" height="20" width="20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"
                            fill-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Posted courses -->
    <div class="down-container">
        <h2 class="down-topic">Posted Courses</h2>
        <div class="flex-container">
            <div class="d-container">
                <div class="image">
                    <img src="../../images/technology.png" alt="Course 1">
                </div>
                <div class="content">
                    <h2>Course 1</h2>
                    <button class="course-btn" onclick="location.href='course_page.html'"> View Course
                        <svg viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" height="20" width="20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"
                                fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="d-container">
                <div class="image">
                    <img src="../../images/technology.png" alt="Course 1">
                </div>
                <div class="content">
                    <h2>Course 1</h2>
                    <button class="course-btn" onclick="location.href='course_page.html'"> View Course
                        <svg viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" height="20" width="20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"
                                fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="d-container">
                <div class="image">
                    <img src="../../images/technology.png" alt="Course 1">
                </div>
                <div class="content">
                    <h2>Course 1</h2>
                    <button class="course-btn" onclick="location.href='course_page.html'"> View Course
                        <svg viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" height="20" width="20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"
                                fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="d-container">
                <div class="image">
                    <img src="../../images/technology.png" alt="Course 1">
                </div>
                <div class="content">
                    <h2>Course 1</h2>
                    <button class="course-btn" onclick="location.href='course_page.html'"> View Course
                        <svg viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" height="20" width="20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"
                                fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="d-container">
                <div class="image">
                    <img src="../../images/technology.png" alt="Course 1">
                </div>
                <div class="content">
                    <h2>Course 1</h2>
                    <button class="course-btn" onclick="location.href='course_page.html'"> View Course
                        <svg viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" height="20" width="20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"
                                fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="d-container">
                <div class="image">
                    <img src="../../images/technology.png" alt="Course 1">
                </div>
                <div class="content">
                    <h2>Course 1</h2>
                    <button class="course-btn" onclick="location.href='course_page.html'"> View Course
                        <svg viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" height="20" width="20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"
                                fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="d-container">
                <div class="image">
                    <img src="../../images/technology.png" alt="Course 1">
                </div>
                <div class="content">
                    <h2>Course 1</h2>
                    <button class="course-btn" onclick="location.href='course_page.html'"> View Course
                        <svg viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" height="20" width="20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"
                                fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>


    </div>

    <script>
    // Pop out edit password container
    const editPasswordBtn = document.getElementById('edit-password-btn');
    const passwordPopup = document.getElementById('password-popup');
    const savePasswordBtn = document.getElementById('save-password-btn');
    const cancelPasswordBtn = document.getElementById('cancel-password-btn');

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

    <script src="../../../src/stylesheets/shared/nav_bar.js"></script>
</body>

</html>