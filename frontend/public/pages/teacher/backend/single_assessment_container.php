<?php 
#Display categoryid,bookid,bookname,bookimg,bookprice and bookaurthor
function single_ass($assID, $courseID, $assTitle, $assDesc) {

    $element = "
    <div class=\"assessment-container\" id=\"next-page\">
        <div class=\"header\">
            <h2>$assTitle</h2>
            <div class=\"view-count\">View: <span id=\"view-count\">0</span></div>
        </div>
        <p class=\"desc\">$assDesc</p>
        <div class=\"assessment-options\">
            <div class=\"status-radio\">
                <input type=\"radio\" id=\"comment\" value=\"comment\">
                <label for=\"comment\">Comment</label>
            </div>
            <div class=\"status-radio\">
                <input type=\"radio\" id=\"exercise\" value=\"exercise\">
                <label for=\"exercise\">Exercise</label>
            </div>
            <div class=\"status-radio\">
                <input type=\"radio\" id=\"additional-note\" value=\"additional-note\">
                <label for=\"additional-note\">Additional Note</label>
            </div>
        </div>
    </div>
    ";

    echo $element;

}