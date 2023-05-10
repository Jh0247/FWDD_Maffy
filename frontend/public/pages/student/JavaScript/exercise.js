const publishExerciseCheckbox = document.getElementById('publish-exercise');
const publishExerciseGroup = document.getElementById('exercise-group');

publishExerciseCheckbox.addEventListener('change', () => {
    if (publishExerciseCheckbox.checked) {
      publishExerciseGroup.style.display = 'block';
    } else {
      publishExerciseGroup.style.display = 'none';
    }
  });