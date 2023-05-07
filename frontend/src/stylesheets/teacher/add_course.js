const form = document.querySelector('form');
const titleInput = document.getElementById('title');
const descriptionInput = document.getElementById('description');
const imageInput = document.getElementById('image');
const submitBtn = document.getElementById('submit-btn');
const postForm = document.getElementById('post-form');

postForm.addEventListener('submit', (e) => {
  e.preventDefault();

  const title = titleInput.value.trim();
  const description = descriptionInput.value.trim();
  // const image = imageInput.value.trim();

  if (title === '' || description === '') {
    showError('Please fill in all the fields');
  } else {
    submitBtn.disabled = true;
    submitBtn.textContent = 'Creating Course...';
    setTimeout(() => {
      submitBtn.textContent = 'Course Created!';
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
  form.reset();
  submitBtn.disabled = false;
  submitBtn.textContent = 'Create Course';
}

// upload image - second design
const fileInput = document.getElementById("file-input");
const previewImage = document.getElementById("preview-image");
const previewMessage = document.getElementById("preview-message");
const previewContainer = document.getElementById("preview-container");

fileInput.addEventListener("change", function() {
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    reader.addEventListener("load", function() {
      previewImage.setAttribute("src", this.result);
      previewMessage.style.display = "none";
      previewImage.style.display = "block";
    });
    reader.readAsDataURL(file);
  } else {
    previewImage.style.display = "none";
    previewMessage.style.display = "block";
    previewMessage.innerHTML = "No image selected";
  }
});