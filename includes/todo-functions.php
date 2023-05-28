<?php
function add_todo_item($todo_text)
{
    var_dump($_POST);
    global $wpdb;
    $table_name = $wpdb->prefix . 'todos';

    // Überprüfen, ob das neue Todo nicht leer ist
    if (!empty($todo_text)) {
        // Fügen Sie den neuen Eintrag in die Datenbank ein
        $wpdb->insert(
            $table_name,
            array(
                'todo_text' => $todo_text,
                'status' => 0, // Status 0 für ausstehendes ToDo
                'priority' => 0 // Standardpriorität
            )
        );
    }
}

function get_todo_items()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'todos';
    $sql = "SELECT * FROM $table_name";
    $todos = $wpdb->get_results($sql);

    return $todos;
}

function delete_todo_item($todo_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'todos';

    // Löschen Sie das ToDo aus der Datenbank basierend auf der ID
    $wpdb->delete(
        $table_name,
        array('id' => $todo_id)
    );
}
