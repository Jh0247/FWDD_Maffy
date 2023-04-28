const form = document.querySelector('form');
const titleInput = document.getElementById('title');
const descriptionInput = document.getElementById('description');
const courseInput = document.getElementById('course');
const contentInput = document.getElementById('content');
const publishCheckbox = document.getElementById('publish');
const publishDateGroup = document.getElementById('publish-date-group');
// const publishDateInput = document.getElementById('publish-date');
const submitBtn = document.getElementById('submit-btn');

publishCheckbox.addEventListener('change', () => {
  if (publishCheckbox.checked) {
    publishDateGroup.style.display = 'block';
  } else {
    publishDateGroup.style.display = 'none';
  }
});

form.addEventListener('submit', (e) => {
  e.preventDefault();

  const title = titleInput.value.trim();
  const description = descriptionInput.value.trim();
  const course = courseInput.value.trim();
  const content = contentInput.value.trim();
  // const publishDate = publishDateInput.value.trim();

  if (title === '' || description === '' || course === '' || content === '') {
    showError('Please fill in all fields');
  } else {
    submitBtn.disabled = true;
    submitBtn.textContent = 'Creating Assessment...';
    setTimeout(() => {
      submitBtn.textContent = 'Assessment Created!';
      resetForm();
    }, 2000);
  }
});

function showError(message) {
  const errorDiv = document.createElement('div');
  errorDiv.classList.add('error');
  errorDiv.textContent = message;
  form.appendChild(errorDiv);
  setTimeout(() => {
    errorDiv.remove();
  }, 100);
}

function resetForm() {
  form.reset();
  publishCheckbox.checked = false;
  publishDateGroup.style.display = 'none';
  submitBtn.disabled = false;
  submitBtn.textContent = 'Create Assessment';
}