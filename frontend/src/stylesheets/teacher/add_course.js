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

// upload image - first design
// const uploadBtn = document.querySelector('.image-btn');
// const fileInput = document.querySelector('input[type="file"]');
// const previewContainer = document.querySelector('.preview-container');
// const previewImage = document.getElementById('preview-image');

// uploadBtn.addEventListener('click', () => {
//   fileInput.click();
// });

// fileInput.addEventListener('change', () => {
//   const file = fileInput.files[0];
//   if (file) {
//     const reader = new FileReader();
//     reader.addEventListener('load', () => {
//       previewImage.setAttribute('src', reader.result);
//       previewContainer.style.display = 'block';
//     });
//     reader.readAsDataURL(file);
//   }
// });


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

// third design
// function previewImage(event) {
//   const previewContainer = document.getElementById('preview-container');
//   previewContainer.style.backgroundImage = `url(${URL.createObjectURL(event.target.files[0])})`;
// }
