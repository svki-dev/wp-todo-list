// ANCHOR - Ajax Request for changing checkbox value
function updateTodoStatus(todoId, isChecked) {
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Configure the AJAX request
    xhr.open('POST', '', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Define the callback function to handle the AJAX response
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Update the ToDo list with the response
            var response = xhr.responseText;
            var pendingTodoList = document.getElementById('pendingTodoList');
            var closedTodoList = document.getElementById('closedTodoList');
            pendingTodoList.innerHTML = '';
            closedTodoList.innerHTML = '';

            // Create a temporary div to parse the response HTML
            var tempDiv = document.createElement('div');
            tempDiv.innerHTML = response;

            // Get the updated lists from the parsed response
            var ulList = tempDiv.querySelectorAll('ul');
            for (var i = 0; i < ulList.length; i++) {
                var ul = ulList[i];
                if (ul.id === 'pendingTodoList') {
                    pendingTodoList.innerHTML = ul.innerHTML;
                } else if (ul.id === 'closedTodoList') {
                    closedTodoList.innerHTML = ul.innerHTML;
                }
            }
        }
    };

    // Prepare the data to be sent in the AJAX request
    var data = 'update_todo_status=1&todo_id=' + encodeURIComponent(todoId) + '&todo_status=' + (isChecked ? '1' : '0');

    // Send the AJAX request
    xhr.send(data);
}

// ANCHOR - Dropdown menu 
document.addEventListener('DOMContentLoaded', function () {
    // Get the necessary elements from the DOM
    let todoTxt = document.querySelector('#todoText');
    let dropdownPrio = document.querySelector('.prio-container');
    let dropdownPrioItems = document.querySelectorAll('.dropdown_prio');

    // Add click event listener to the todoText element
    todoTxt.addEventListener('click', function () {
        dropdownPrio.classList.toggle("dropdown_active");
    });

    // Add click event listeners to each dropdown_prio item
    dropdownPrioItems.forEach(item => {
        item.addEventListener('click', function () {
            // Get the priority value from the dataset of the clicked item
            let itemPrio = item.dataset.prio;
            let todoPrio = document.querySelector('#todoPrio');

            // Set the selected priority value to the todoPrio input field
            todoPrio.value = itemPrio;
            todoTxt.setAttribute("aria-prio", itemPrio);
            console.log(todoPrio);
        });
    });
});



