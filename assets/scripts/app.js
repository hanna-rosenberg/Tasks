const form = document.querySelector('#checkboxForm');
const taskForm = document.querySelector('#tasksForm');
const tasks = document.querySelectorAll('.checkboxClass');
const todayTasks = document.querySelectorAll('.checkboxToday');

if (todayTasks.length !== 0) {
  todayTasks.forEach((task) => {
    task.addEventListener('click', () => {
      form.submit();
    });
  });
}

if (tasks.length !== 0) {
  tasks.forEach((task) => {
    task.addEventListener('click', () => {
      taskForm.submit();
    });
  });
}
