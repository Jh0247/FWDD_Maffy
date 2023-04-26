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

// responsive dropdown list
// const profileIconRes = document.getElementById("profile-icon");
// const profileDropdownRes = document.getElementById("profile-dropdown");

// profileIconRes.addEventListener("click", () => {
//   if (profileDropdownRes.style.display === "block") {
//     profileDropdownRes.style.display = "none";
//   } else {
//     profileDropdownRes.style.display = "block";
//   }
// });

// Swaping login register button
// const loginBtn = document.getElementById("login-btn");
// const registerBtn = document.getElementById("register-btn");
// const activeIndicator = document.querySelector(".active-indicator");

// loginBtn.addEventListener("click", function() {
//   loginBtn.classList.add("active");
//   registerBtn.classList.remove("active");
//   activeIndicator.style.transform = "translateX(0)";
// });

// registerBtn.addEventListener("click", function() {
//   registerBtn.classList.add("active");
//   loginBtn.classList.remove("active");
//   activeIndicator.style.transform = "translateX(100%)";
// });

// menu responsive
const navToggle = document.querySelector('.nav-toggle');
const navLinks = document.querySelector('.nav-links');

navToggle.addEventListener('click', () => {
  navLinks.classList.toggle('active');
  navToggle.classList.toggle('active');
});

// my-profile
const profileToggle = document.querySelector('.profile-res');
const profileDropdownList = document.querySelector('.profile-dropdown_links');

profileToggle.addEventListener('click', () => {
  profileToggle.classList.toggle('active');
  profileDropdownList.classList.toggle('active');
});

//side-bar hamburger
const menu_btn = document.querySelector('.hamburger');
const side_nav = document.querySelector('.side-nav');

menu_btn.addEventListener('click',function(){
  menu_btn.classList.toggle('is-active');
  side_nav.classList.toggle('is-active');
});