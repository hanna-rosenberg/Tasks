const todayForms = document.querySelectorAll('.checkboxForm');
const taskForms = document.querySelectorAll('.tasksForm');
const deadlineToday = document.querySelectorAll('.deadlineToday');

if (todayForms.length !== 0) {
  setCheckboxEventListener(todayForms);
}

if (taskForms.length !== 0) {
  setCheckboxEventListener(taskForms);
}

if (deadlineToday.length !== 0) {
  setCheckboxEventListener(deadlineToday);
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
