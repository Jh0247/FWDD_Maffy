//get class and id
const searchBar = document.getElementById("search-bar");
const items = document.querySelectorAll(".item-cont");

//add event listener
searchBar.addEventListener("input", () => {
  //get search bar value
  const query = searchBar.value.trim().toLowerCase();

  items.forEach(item => {
    const name = item.querySelector("h2").textContent.trim().toLowerCase();
    const email = item.querySelector("h3").textContent.trim().toLowerCase();
    const data = item.querySelector("span").textContent.trim().toLowerCase();
    
    if (name.includes(query) || email.includes(query) || data.includes(query)) {
      item.style.display = "flex";
    } else {
      item.style.display = "none";
    }
  });
});


// add event listener to all radio buttons
var radios = document.querySelectorAll('input[name="switch"]');
for (var i = 0; i < radios.length; i++) {
  radios[i].addEventListener('click', function() {
    // get the selected switch value
    var switchValue = this.value;
    // update the URL with the selected switch value
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('switch')) {
      //find the switch params and replace with new value
      urlParams.set('switch', switchValue);
      window.location.search = urlParams.toString();
    } else {
      //if no switch params then add in
      window.location.href = window.location.href + '&switch=' + switchValue;
    }
  });
}

// Get the value of the "switch" parameter from the URL
const urlParams = new URLSearchParams(window.location.search);
const switchParam = urlParams.get('switch');

// Get the radio buttons and labels
const activeRadio = document.getElementById('active');
const activeLabel = document.querySelector('label[for="active"]');
const banRadio = document.getElementById('ban');
const banLabel = document.querySelector('label[for="ban"]');
const allRadio = document.getElementById('all');
const allLabel = document.querySelector('label[for="all"]');

// Set the checked attribute based on the value of the "switch" parameter
switch (switchParam) {
  case 'active':
    activeRadio.checked = true;
    activeLabel.classList.add('checked');
    break;
  case 'ban':
    banRadio.checked = true;
    banLabel.classList.add('checked');
    break;
  default:
    allRadio.checked = true;
    allLabel.classList.add('checked');
}