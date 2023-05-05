const filterOption = document.querySelector('.filter');
const filterContainer = document.querySelector('.filter-container');

// Event listener for Filter option click
filterOption.addEventListener('click', () => {
    if (filterContainer.style.display === "block") {
        filterContainer.style.display = "none";
    } else {
        filterContainer.style.display = "block";
    }
});

const applyButton = document.querySelector('.apply-button');
applyButton.addEventListener('click', applyFilters);

function applyFilters() {
  const lastestCheckbox = document.querySelector('#lastest-checkbox');
  const oldestCheckbox = document.querySelector('#oldest-checkbox');
  const commentRadio = document.querySelector('#comment-radio');
  const exerciseRadio = document.querySelector('#exercise-radio');
  const noteRadio = document.querySelector('#note-radio');
  
  const lastestChecked = lastestCheckbox.checked;
  const oldestChecked = oldestCheckbox.checked;
  const commentChecked = commentRadio.checked;
  const exerciseChecked = exerciseRadio.checked;
  const noteChecked = noteRadio.checked;
  
  // Code to filter based on selected options
}



// You can add functionality to the save button to submit the form data