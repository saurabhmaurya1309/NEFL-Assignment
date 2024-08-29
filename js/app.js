
document.addEventListener('DOMContentLoaded', function () {
    const taskForm = document.getElementById('add-task-form');
    const taskInput = document.getElementById('task');
    const tasksList = document.getElementById('tasks');

    // Add a new task
    taskForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const task = taskInput.value.trim();
        if (task !== '') {
            const formData = new FormData();
            formData.append('task', task);

            fetch('tasks/add_task.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                loadTasks(); 
                taskInput.value = '';
            });
        }
    });

    
    function loadTasks() {
        fetch('tasks/load_tasks.php')
            .then(response => response.json())
            .then(tasks => {
                const tasksList = document.getElementById('tasks');
                tasksList.innerHTML = '';
                tasks.forEach(task => {
                    const li = document.createElement('li');
                    const taskText = document.createElement('span');
                    taskText.textContent = task.task;
                    taskText.className = task.completed ? 'completed-task-text' : '';
    
                    const editButton = document.createElement('button');
                    editButton.innerHTML = '✏️'; // Edit icon
                    editButton.className = 'edit-btn';
                    editButton.addEventListener('click', () => editTask(task.id, task.task));
    
                    const deleteButton = document.createElement('button');
                    deleteButton.textContent = 'Delete';
                    deleteButton.className = 'delete-btn';

                    deleteButton.addEventListener('click', () => deleteTask(task.id));
    
                    const completeCheckbox = document.createElement('input');
                    completeCheckbox.type = 'checkbox';
                    completeCheckbox.checked = task.completed;
                    completeCheckbox.addEventListener('change', () => completeTask(task.id));
    
                    // Append elements
                    li.appendChild(completeCheckbox);
                    li.appendChild(taskText);
                    li.appendChild(editButton);
                    li.appendChild(deleteButton);
                    tasksList.appendChild(li);
                });
            });
    }
    function deleteTask(id) {
        const formData = new FormData();
        formData.append('id', id);

        fetch('tasks/delete_task.php', {
            method: 'POST',
            body: formData
        })
        .then(() => loadTasks());
    }
    function completeTask(id) {
        const formData = new FormData();
        formData.append('id', id);

        fetch('tasks/complete_task.php', {
            method: 'POST',
            body: formData
        })
        .then(() => loadTasks());
    }

    // Edit a task
    function editTask(id, currentTask) {
        const newTask = prompt("Edit task:", currentTask);
        if (newTask !== null && newTask.trim() !== "") {
            const formData = new FormData();
            formData.append('id', id);
            formData.append('task', newTask);

            fetch('tasks/edit_task.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    loadTasks();
                } else {
                    alert(data.message);
                }
            });
        }
    }

    loadTasks(); 
});
