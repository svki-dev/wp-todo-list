<?php
// Function to create the database table for the ToDo entries
function create_todo_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'todos';
    $charset_collate = $wpdb->get_charset_collate();

    // SQL query to create the table
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id INT(11) NOT NULL AUTO_INCREMENT,
        todo_text TEXT NOT NULL,
        status TINYINT(1) NOT NULL DEFAULT 0,
        priority TEXT NOT NULL,
        PRIMARY KEY (id),
        UNIQUE (id)
    ) $charset_collate;";

    // WordPress function to execute the SQL query
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

create_todo_table();
