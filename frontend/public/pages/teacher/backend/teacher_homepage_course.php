<?php 
#Display categoryid,bookid,bookname,bookimg,bookprice and bookaurthor
function trendCourses($courseID, $userID, $courseTitle, $courseImg) {

    $element = "
    <div class=\"container\">
        <div class=\"image\">
            <img src=\"$courseImg\" alt=\"Course 1\">
        </div>
        <div class=\"content\">
            <h2>$courseTitle</h2>
            <button class=\"course-btn\" onclick=\"location.href='../../pages/shared/course_page.php?userid=$userID&courseid=$courseID'\"> View Course
                <svg viewBox=\"0 0 16 16\" class=\"bi bi-arrow-right\" fill=\"currentColor\" height=\"20\" width=\"20\"
                    xmlns=\"http://www.w3.org/2000/svg\">
                    <path
                        d=\"M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z\"
                        fill-rule=\"evenodd\"></path>
                </svg>
            </button>
        </div>
    </div>
    ";

    echo $element;

}

function allCourses($courseID, $userID, $courseTitle, $courseImg) {
    
    $element = "
    
    <div class=\"d-container\">
        <div class=\"image\">
            <img src=\"$courseImg\" alt=\"Course 1\">
        </div>
        <div class=\"content\">
            <h2>$courseTitle</h2>
            <button class=\"course-btn\" onclick=\"location.href='../../pages/shared/course_page.php?userid=$userID&courseid=$courseID'\"> View Course
                <svg viewBox=\"0 0 16 16\" class=\"bi bi-arrow-right\" fill=\"currentColor\" height=\"20\" width=\"20\"
                    xmlns=\"http://www.w3.org/2000/svg\">
                    <path
                        d=\"M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z\"
                        fill-rule=\"evenodd\"></path>
                </svg>
            </button>
        </div>
    </div>
    
    ";

    echo $element;
    
}

?>