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
const profileToggle_menu = document.querySelector('.profile-res');
const profileDropdownList_menu = document.querySelector('.profile-dropdown_links');

navToggle.addEventListener('click', () => {
  navLinks.classList.toggle('active');
  navToggle.classList.toggle('active');

  if (profileDropdownList_menu.classList.contains('active')) {
    profileDropdownList_menu.classList.remove('active');
    profileDropdownList_menu.classList.add('inactive');
  }
});

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

// my-profile
const profileToggle = document.querySelector('.profile-res');
const profileDropdownList = document.querySelector('.profile-dropdown_links');

profileToggle.addEventListener('click', () => {
  profileToggle.classList.toggle('active');
  profileDropdownList.classList.toggle('active');
});