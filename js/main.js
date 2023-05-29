function updateTodoStatus(todoId, isChecked) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // ToDo-Liste aktualisieren
            var response = xhr.responseText;
            var pendingTodoList = document.getElementById('pendingTodoList');
            var closedTodoList = document.getElementById('closedTodoList');
            pendingTodoList.innerHTML = '';
            closedTodoList.innerHTML = '';
            var tempDiv = document.createElement('div');
            tempDiv.innerHTML = response;
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
    var data = 'update_todo_status=1&todo_id=' + encodeURIComponent(todoId) + '&todo_status=' + (isChecked ? '1' : '0');
    xhr.send(data);
}