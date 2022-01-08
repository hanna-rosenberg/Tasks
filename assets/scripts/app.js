const todayForms = document.querySelectorAll('.checkboxForm');
const taskForms = document.querySelectorAll('.tasksForm');

if (todayForms.length !== 0) {
  setCheckboxEventListener(todayForms);
}

if (taskForms.length !== 0) {
  setCheckboxEventListener(taskForms);
}

// funktion för att submitta formet
function setCheckboxEventListener(forms) {
  forms.forEach((form) => {
    const checkbox = form.querySelector('.checkboxClass');
    checkbox.addEventListener('click', () => {
      form.submit();
    });
  });
} 