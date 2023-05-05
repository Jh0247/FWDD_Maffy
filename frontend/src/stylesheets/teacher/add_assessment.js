const form = document.querySelector('form');
const titleInput = document.getElementById('title');
const contentInput = document.getElementById('content');
const publishCheckbox = document.getElementById('publish');
const publishExerciseCheckbox = document.getElementById('publish-exercise');
const publishDateGroup = document.getElementById('publish-date-group');
const publishExerciseGroup = document.getElementById('exercise-group');
const submitBtn = document.getElementById('submit-btn');
const postForm = document.getElementById('post-form');

publishCheckbox.addEventListener('change', () => {
  if (publishCheckbox.checked) {
    publishDateGroup.style.display = 'block';
  } else {
    publishDateGroup.style.display = 'none';
  }
});

publishExerciseCheckbox.addEventListener('change', () => {
  if (publishExerciseCheckbox.checked) {
    publishExerciseGroup.style.display = 'block';
  } else {
    publishExerciseGroup.style.display = 'none';
  }
});

postForm.addEventListener('submit', (e) => {
  e.preventDefault();

  const title = titleInput.value.trim();
  const content = contentInput.value.trim();

  if (title === '' || content === '') {
    showError('Please fill in the Title and Content fields');
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
  postForm.appendChild(errorDiv);
  setTimeout(() => {
    errorDiv.remove();
  }, 1000);
}

function resetForm() {
  postForm.reset();
  publishCheckbox.checked = false;
  publishDateGroup.style.display = 'none';
  publishExerciseGroup.style.display = 'none';
  submitBtn.disabled = false;
  submitBtn.textContent = 'Create Assessment';
}

// back button
function goBack() {
  window.history.back();
}
