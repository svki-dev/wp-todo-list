<?php
include_once plugin_dir_path(__FILE__) . '../includes/todo-functions.php';

function render_todo_page()
{
    $todos = get_todo_items();

    // Überprüfen, ob das Formular abgeschickt wurde und ein neues ToDo hinzugefügt werden soll
    if (isset($_POST['add_todo'])) {
        $new_todo_text = $_POST['todo_text'];
        add_todo_item($new_todo_text);

        // Aktualisieren Sie die Liste der ToDos
        $todos = get_todo_items();
    }

    // Überprüfen, ob das Löschformular abgeschickt wurde und ein ToDo gelöscht werden soll
    if (isset($_POST['delete_todo'])) {
        $todo_id = $_POST['todo_id'];
        delete_todo_item($todo_id);

        // Aktualisieren Sie die Liste der ToDos
        $todos = get_todo_items();
    }

?>

    <div class="todo-container">
        <div class="todo-wrapper">
            <div class="pending-todo-wrapper">
                <h2>Pending ToDos</h2>
                <div class="pending-todo-list">
                    <form method="post" action="">
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
                                        <input type="hidden" name="todo_id" value="<?php echo $todo_id ?>">
                                        <input type="checkbox" name="todo_status" id="todo_<?php echo $todo_id ?>_checkbox" <?php echo $checked_attr ?>>
                                        <label for="todo_<?php echo $todo_id ?>_checkbox">
                                            <span><?php echo $todo_text ?></span>
                                        </label>
                                        <button class="todo-btn delet" type="submit" name="delete_todo"></button>
                                    </li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                    </form>
                </div>
            </div>
            <div class="closed-todo-wrapper">
                <h2>Closed Todos</h2>
                <div class="closed-todo-list">
                    <form method="post" action="">
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
                                        <input type="hidden" name="todo_id" value="<?php echo $todo_id ?>">
                                        <input type="checkbox" name="todo_status" id="todo_<?php echo $todo_id ?>_checkbox" <?php echo $checked_attr ?>>
                                        <label for="todo_<?php echo $todo_id ?>_checkbox">
                                            <span><?php echo $todo_text ?></span>
                                        </label>
                                        <button class="todo-btn delet" type="submit" name="delete_todo"></button>
                                    </li>

                            <?php }
                                } ?>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
        <div class="add-todo-wrapper">
            <div class="add-todo">
                <h2>Add Todos</h2>
                <form id="addTodoForm" method="post" action="">
                    <input type="text" name="todo_text" id="todoText"> <!-- Hinzufügen des Namens "todo_text" für das Eingabefeld -->
                    <button class="todo-btn add" type="submit" name="add_todo"></button> <!-- Ändern des Typs in "submit" -->
                </form>
            </div>
        </div>
    </div>
<?php }

?>