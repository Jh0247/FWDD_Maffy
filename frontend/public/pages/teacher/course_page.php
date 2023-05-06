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
    <link rel="stylesheet" href="../../../src/stylesheets/teacher/course_page.css">
    <link rel="stylesheet" href="../../../src/stylesheets/shared/nav_bar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>Add Course</title>

</head>

<body>
    <?php include '../shared/navbar.php';?>
    <header>
        <div class="cover-image">
            <img src="../../images/technology.png" alt="Cover Image">
            <div class="cover-text">
                <h1>Title</h1>
                <p>Description</p>
            </div>
        </div>
    </header>

    <!-- status container -->
    <div class="container">
        <div class="options">
            <div class="option">
                <a href="add_assessment.php"><i class="fas fa-plus"></i> Add Assessment</a>
            </div>
            <div class="option">
                <a href="#"><i class="fas fa-edit"></i> Edit</a>
            </div>
            <div class="option">
                <a href="#"><i class="fas fa-trash"></i> Delete</a>
            </div>
            <div class="option filter">
                <a href="#"><i class="fas fa-filter"></i> Filter</a>
            </div>
        </div>
        <div class="publish-container">
            <p class="published">Unpublished</p>
        </div>

    </div>

    <!-- hidden filter column -->
    <div class="filter-container hidden">
        <h3>Filter Options</h3>
        <h4>Filter By:</h4>
        <div class="filter-row">
            <div class="filter-column">
                <input type="checkbox" id="latest" name="latest">
                <label for="latest">Latest</label>
                <br><br>
                <input type="checkbox" id="oldest" name="oldest">
                <label for="oldest">Oldest</label>
            </div>
            <div class="filter-column">
                <div class="filter-radio">
                    <input type="radio" id="comment" name="filter" value="comment">
                    <label for="comment">Comment</label>
                </div>
                <div class="filter-radio">
                    <input type="radio" id="exercise" name="filter" value="exercise">
                    <label for="exercise">Exercise</label>
                </div>
                <div class="filter-radio">
                    <input type="radio" id="additional-note" name="filter" value="additional-note">
                    <label for="additional-note">Additional Note</label>
                </div>
            </div>
        </div>
        <button class="apply-btn">Apply</button>
    </div>

    <!-- single asssessment status container -->
    <div class="assessment-container" id="next-page">
        <div class="header">
            <h2>COURSE 1</h2>
            <div class="view-count">View: <span id="view-count">0</span></div>
        </div>
        <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget orci tempor,
            consectetur ante nec, congue mi.</p>
        <div class="assessment-options">
            <div class="status-radio">
                <input type="radio" id="comment" value="comment">
                <label for="comment">Comment</label>
            </div>
            <div class="status-radio">
                <input type="radio" id="exercise" value="exercise">
                <label for="exercise">Exercise</label>
            </div>
            <div class="status-radio">
                <input type="radio" id="additional-note" value="additional-note">
                <label for="additional-note">Additional Note</label>
            </div>
        </div>
    </div>

    <div class="assessment-container" id="next-page">
        <div class="header">
            <h2>COURSE 1</h2>
            <div class="view-count">View: <span id="view-count">0</span></div>
        </div>
        <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget orci tempor,
            consectetur ante nec, congue mi.</p>
        <div class="assessment-options">
            <div class="status-radio">
                <input type="radio" id="comment" value="comment">
                <label for="comment">Comment</label>
            </div>
            <div class="status-radio">
                <input type="radio" id="exercise" value="exercise">
                <label for="exercise">Exercise</label>
            </div>
            <div class="status-radio">
                <input type="radio" id="additional-note" value="additional-note">
                <label for="additional-note">Additional Note</label>
            </div>
        </div>
    </div>

    <div class="assessment-container" id="next-page">
        <div class="header">
            <h2>COURSE 1</h2>
            <div class="view-count">View: <span id="view-count">0</span></div>
        </div>
        <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget orci tempor,
            consectetur ante nec, congue mi.</p>
        <div class="assessment-options">
            <div class="status-radio">
                <input type="radio" id="comment" value="comment">
                <label for="comment">Comment</label>
            </div>
            <div class="status-radio">
                <input type="radio" id="exercise" value="exercise">
                <label for="exercise">Exercise</label>
            </div>
            <div class="status-radio">
                <input type="radio" id="additional-note" value="additional-note">
                <label for="additional-note">Additional Note</label>
            </div>
        </div>
    </div>

    <div class="assessment-container" id="next-page">
        <div class="header">
            <h2>COURSE 1</h2>
            <div class="view-count">View: <span id="view-count">0</span></div>
        </div>
        <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget orci tempor,
            consectetur ante nec, congue mi.</p>
        <div class="assessment-options">
            <div class="status-radio">
                <input type="radio" id="comment" value="comment">
                <label for="comment">Comment</label>
            </div>
            <div class="status-radio">
                <input type="radio" id="exercise" value="exercise">
                <label for="exercise">Exercise</label>
            </div>
            <div class="status-radio">
                <input type="radio" id="additional-note" value="additional-note">
                <label for="additional-note">Additional Note</label>
            </div>
        </div>
    </div>

    <script>
    const myDiv = document.getElementById("next-page");
    myDiv.addEventListener("click", () => {
        window.location.href =
            "../../../public/pages/teacher/view_courses.html"; // replace with your desired URL
    });

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

    <script src="../../../src/stylesheets/teacher/course_page.js"></script>
    <script src="../../../src/stylesheets/shared/nav_bar.js"></script>
</body>

</html>