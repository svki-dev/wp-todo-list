<?php
// Block direct access to the file
defined('ABSPATH') || exit;

// Include the necessary functions file
include_once plugin_dir_path(__FILE__) . '../includes/todo-functions.php';

// Function to render the todo page
function render_todo_page()
{
    // Get the list of todo items
    $todos = get_todo_items();

    // Check if the add_todo form was submitted and a new todo needs to be added
    if (isset($_POST['add_todo'])) {
        $new_todo_text = $_POST['todo_text'];
        $new_todo_prio = $_POST['todo_prio'];
        add_todo_item($new_todo_text, $new_todo_prio);

        // Update the todo list
        $todos = get_todo_items();
    }

    // Check if the delete_todo form was submitted and a todo needs to be deleted
    if (isset($_POST['delete_todo'])) {
        $todo_id = $_POST['todo_id'];
        delete_todo_item($todo_id);

        // Update the todo list
        $todos = get_todo_items();

        // No page redirection since the update is asynchronous
    }

    // Check if the update_todo_status form was submitted and a todo status needs to be updated
    if (isset($_POST['update_todo_status'])) {
        $todo_id = $_POST['todo_id'];
        $todo_status = $_POST['todo_status'];
        update_todo_status($todo_id, $todo_status);

        // Update the todo list
        $todos = get_todo_items();

        // No page redirection since the update is asynchronous
    }
?>
    <div class="todo-container">
        <div class="todo-wrapper">
            <div class="pending-todo-wrapper">
                <h2>Pending ToDos</h2>
                <div class="pending-todo-list">
                    <ul id="pendingTodoList">
                        <?php
                        // Iterate through the todos and display the pending ones
                        foreach ($todos as $todo) {
                            $todo_id = $todo->id;
                            $todo_text = $todo->todo_text;
                            $todo_status = $todo->status;
                            $todo_priority = $todo->priority;
                            if ($todo_status == 0) {
                                $checked_attr = '';
                        ?>
                                <li id="todo_<?php echo $todo_id ?>" aria-priority="<?php echo $todo_priority ?>">
                                    <form method="post" action="">
                                        <input type="hidden" name="todo_id" value="<?php echo $todo_id ?>">
                                        <input type="checkbox" name="todo_status" id="todo_<?php echo $todo_id ?>_checkbox" <?php echo $checked_attr ?> onchange="updateTodoStatus(<?php echo $todo_id ?>, this.checked)">
                                        <label for="todo_<?php echo $todo_id ?>_checkbox">
                                            <span><?php echo $todo_text ?></span>
                                        </label>
                                        <button class="todo-btn delet" type="submit" name="delete_todo"></button>
                                    </form>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="closed-todo-wrapper">
                <h2>Closed Todos</h2>
                <div class="closed-todo-list">
                    <ul id="closedTodoList">
                        <?php
                        // Iterate through the todos and display the closed ones
                        foreach ($todos as $todo) {
                            $todo_id = $todo->id;
                            $todo_text = $todo->todo_text;
                            $todo_status = $todo->status;
                            $todo_priority = $todo->priority;
                            if ($todo_status == 1) {
                                $checked_attr = 'checked';
                        ?>
                                <li id="todo_<?php echo $todo_id ?>" aria-priority="<?php echo $todo_priority ?>">
                                    <form method="post" action="">
                                        <input type="hidden" name="todo_id" value="<?php echo $todo_id ?>">
                                        <input type="checkbox" name="todo_status" id="todo_<?php echo $todo_id ?>_checkbox" <?php echo $checked_attr ?> onchange="updateTodoStatus(<?php echo $todo_id ?>, this.checked)">
                                        <label for="todo_<?php echo $todo_id ?>_checkbox">
                                            <span><?php echo $todo_text ?></span>
                                        </label>
                                        <button class="todo-btn delet" type="submit" name="delete_todo"></button>
                                    </form>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="add-todo-wrapper">
            <div class="add-todo">
                <h2>Add Todos</h2>
                <form id="addTodoForm" method="post" action="">
                    <input type="text" name="todo_text" id="todoText">
                    <input type="text" name="todo_prio" id="todoPrio" class="" hidden>
                    <div class="prio-container">
                        <ul>
                            <li class="dropdown_prio high" data-prio="high">High</li>
                            <li class="dropdown_prio medium" data-prio="medium">Medium</li>
                            <li class="dropdown_prio low" data-prio="low">Low</li>
                        </ul>
                    </div>
                    <button class="todo-btn add" type="submit" name="add_todo"></button>
                </form>
            </div>
        </div>
    </div>
<?php
}
?>