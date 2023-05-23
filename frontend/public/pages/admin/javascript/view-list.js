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


// add on click function to radio buttons
$('input[name="switch"]').click(function() {
  // Get the selected switch value
  var switchValue = $(this).val();
  
  // Update the URL with the selected switch value
  var urlParams = new URLSearchParams(window.location.search);
  
  if (urlParams.has('switch')) {
    // Find the switch parameter and replace with the new value
    urlParams.set('switch', switchValue);
    window.location.search = urlParams.toString();
  } else {
    // If no switch parameter, then add it to the URL
    window.location.href = window.location.href + '&switch=' + switchValue;
  }
});

// Get the value of the "switch" parameter from the URL
const urlParams = new URLSearchParams(window.location.search);
const switchParam = urlParams.get('switch');

// Get the radio buttons and labels
const activeRadio = $('#active');
const activeLabel = $('label[for="active"]');
const banRadio = $('#ban');
const banLabel = $('label[for="ban"]');
const allRadio = $('#all');
const allLabel = $('label[for="all"]');

// Set the checked attribute based on the value of the "switch" parameter
switch (switchParam) {
  case 'active':
    activeRadio.prop('checked', true);
    activeLabel.addClass('checked');
    break;
  case 'ban':
    banRadio.prop('checked', true);
    banLabel.addClass('checked');
    break;
  default:
    allRadio.prop('checked', true);
    allLabel.addClass('checked');
}