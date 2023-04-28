
const commentIcon = document.querySelector('.fa-comment');
const commentForm = document.querySelector('.comment-form');
const commentTextarea = document.querySelector('.comment-form textarea');
const commentsContainer = document.querySelector('.comments');
const addCommentBtn = document.querySelector('.comment-form button');


commentIcon.addEventListener('click', () => {
  commentForm.style.display = 'block';
});

addCommentBtn.addEventListener('click', (e) => {
  e.preventDefault();
  const comment = commentTextarea.value.trim();
  if (comment !== '') {
    const username = 'John Doe'; // Replace with actual username
    const date = new Date().toLocaleString();
    const commentDiv = document.createElement('div');
    commentDiv.classList.add('comment');
    commentDiv.innerHTML = `
      <div class="user-profile">
        <img src="https://via.placeholder.com/50" alt="User Profile">
        <div>
          <p>${username}</p>
          <span>${date}</span>
        </div>
      </div>
      <p>${comment}</p>
    `;
    commentsContainer.appendChild(commentDiv);
    commentTextarea.value = '';
    commentForm.style.display = 'none';
  }
});