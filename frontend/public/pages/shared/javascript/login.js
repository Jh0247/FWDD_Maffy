//==============================================================================
// script on handling tab swapping for the login and signup
$(document).ready(function () {
  // Add "active" class to "login" tab by default
  $('.tab a[href="#login"]').addClass("active");

  // Hide all tab contents except "login"
  $('.tab-content > div:not("#login")').hide();

  // When a tab is clicked, show its corresponding content and hide the others
  $(".tab a").on("click", function (e) {
    e.preventDefault();

    // Remove "active" class from all tabs
    $(".tab a").removeClass("active");

    // Add "active" class to clicked tab
    $(this).addClass("active");

    // Hide all tab contents except the one that matches the clicked tab
    $(".tab-content > div").hide();
    $($(this).attr("href")).show();
  });
});

//==============================================================================
// function to add some animation on the login container
// get container id
const con = document.querySelector(".lgn-container");
// when mouse in and out
let isIn = true;
let isOut = false;
var span;

con.addEventListener("mouseenter", (e) => {
  if (isIn) {
    let inX = e.clientX - e.target.offsetLeft;
    let inY = e.clientY - e.target.offsetTop;

    let el = document.createElement("span");
    el.style.left = inX + "px";
    el.style.top = inY + "px";
    con.appendChild(el);

    $(".lgn-container span").removeClass("out");
    $(".lgn-container span").addClass("in");

    span = document.querySelector(".lgn-container span");
    isIn = false;
    isOut = true;
  }
});

con.addEventListener("mouseleave", (e) => {
  if (isOut) {
    let outX = e.clientX - e.target.offsetLeft;
    let outY = e.clientY - e.target.offsetTop;

    $(".lgn-container span").removeClass("in");
    $(".lgn-container span").addClass("out");

    $(".out").css("left", outX + "px");
    $(".out").css("top", outY + "px");

    isOut = true;
    setTimeout(() => {
      con.removeChild(span);
      isIn = true;
    }, 500);
  }
});
//==============================================================================
// function to hide and show the upload file container for teacher
const radioButtons = document.querySelectorAll('input[type="radio"]');
const uploadContainer = document.querySelector(".upload-container");

uploadContainer.style.display = "none"; // set display to none by default

radioButtons.forEach((radio) => {
  radio.addEventListener("click", () => {
    if (radio.value === "teacher") {
      uploadContainer.style.display = "block";
    } else {
      uploadContainer.style.display = "none";
    }
  });
});

// Get the radio buttons and file input
const teacherRadio = document.querySelector('input[value="teacher"]');
const studentRadio = document.querySelector('input[value="student"]');
const fileUpload = document.getElementById("fileUpload");

// Add an event listener to the teacher radio button
teacherRadio.addEventListener("change", function () {
  if (teacherRadio.checked) {
    fileUpload.setAttribute("required", "required");
  }
});
studentRadio.addEventListener("change", function () {
  if (studentRadio.checked) {
    fileUpload.removeAttribute("required");
  }
});
