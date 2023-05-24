<?php
function render_todo_page()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'todos';
    $sql = "SELECT * FROM $table_name";
    $todos = $wpdb->get_results($sql);


?>
    <div class="todo-container">
        <div class="todo-wrapper">
            <div class="pending-todo-wrapper">
                <h2>Pending ToDos</h2>
                <div class="pending-todo-list">
                    <ul>
                        <?php
                        foreach ($todos as $todo) {
                            $todo_id = $todo->id;
                            $todo_text = $todo->todo_text;
                            $todo_status = $todo->status;
                            $todo_priority = $todo->priority;
                            if ($todo_status == 0) {
                                $checked_attr = '';
                        ?>
                                <li id="todo_<?php echo $todo_id ?>" aria-priority="<?php echo $todo_priority ?>">
                                    <input type="checkbox" name="" id="" <?php echo $checked_attr ?>>
                                    <span><?php echo $todo_text ?></span>
                                    <button class="todo-btn delet" type="submit"></button>
                                </li>

                        <?php }
                        } ?>
                    </ul>
                </div>
            </div>
            <div class="closed-todo-wrapper">
                <h2>Closed Todos</h2>
                <div class="closed-todo-list">
                    <ul> <?php
                            foreach ($todos as $todo) {
                                $todo_id = $todo->id;
                                $todo_text = $todo->todo_text;
                                $todo_status = $todo->status;
                                $todo_priority = $todo->priority;
                                if ($todo_status == 1) {
                                    $checked_attr = 'checked';
                            ?>
                                <li id="todo_<?php echo $todo_id ?>" aria-priority="<?php echo $todo_priority ?>">
                                    <input type="checkbox" name="" id="" <?php echo $checked_attr ?>>
                                    <span><?php echo $todo_text ?></span>
                                    <button class="todo-btn delet" type="submit"></button>
                                </li>

                        <?php }
                            } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="add-todo-wrapper">
            <div class="add-todo">
                <h2>Add Todos</h2>
                <form id="addTodoForm" action="">
                    <input type="text" name="" id="todoText">
                    <button class="todo-btn add" type="button" onclick="addTodo()"></button>
                </form>
            </div>
        </div>
    </div>
<?php }

?>