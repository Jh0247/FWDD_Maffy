const menu_btn = document.querySelector('.hamburger');
const side_nav = document.querySelector('.sidebar');

menu_btn.addEventListener('click',function(){
  menu_btn.classList.toggle('is-active');
  side_nav.classList.toggle('active');
});