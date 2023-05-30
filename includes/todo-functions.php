<?php
// Block direct access to the file
defined('ABSPATH') || exit;

/**
 * Adds a new to-do item.
 *
 * @param string $todo_text The text of the to-do.
 * @param string $todo_priority The priority of the to-do.
 */
function add_todo_item($todo_text, $todo_priority)
{
    if (!current_user_can('administrator')) {
        return;
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'todos';

    $todo_text = sanitize_text_field($todo_text);
    $todo_priority = sanitize_text_field($todo_priority);

    if (!empty($todo_text) && !empty($todo_priority)) {
        $wpdb->insert(
            $table_name,
            array(
                'todo_text' => $todo_text,
                'status' => 0, // Status 0 for pending to-do
                'priority' => $todo_priority
            ),
            array(
                '%s',
                '%d',
                '%s'
            )
        );

        if ($wpdb->last_error) {
            $error_message = 'An error occurred during the database interaction: ' . $wpdb->last_error;
            error_log($error_message);
            wp_die($error_message);
        }
    }
}

/**
 * Retrieves all to-do items.
 *
 * @return array An array of to-do items.
 */
function get_todo_items()
{
    if (!current_user_can('administrator')) {
        return array(); // Return an empty array if not an administrator
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'todos';
    $sql = "SELECT * FROM $table_name";
    $todos = $wpdb->get_results($sql);

    return $todos;
}

/**
 * Deletes a to-do item.
 *
 * @param int $todo_id The ID of the to-do to delete.
 */
function delete_todo_item($todo_id)
{
    if (!current_user_can('administrator')) {
        return; // Execute the function only for administrators
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'todos';
    $wpdb->delete(
        $table_name,
        array('id' => $todo_id),
        array('%d')
    );

    if ($wpdb->last_error) {
        $error_message = 'An error occurred during the database interaction: ' . $wpdb->last_error;
        error_log($error_message);
        wp_die($error_message);
    }
}

/**
 * Updates the status of a to-do item.
 *
 * @param int $todo_id The ID of the to-do to update.
 * @param int $todo_status The new status of the to-do.
 */
function update_todo_status($todo_id, $todo_status)
{
    if (!current_user_can('administrator')) {
        return; // Execute the function only for administrators
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'todos';
    $wpdb->update(
        $table_name,
        array('status' => $todo_status),
        array('id' => $todo_id),
        array('%d'),
        array('%d')
    );

    if ($wpdb->last_error) {
        $error_message = 'An error occurred during the database interaction: ' . $wpdb->last_error;
        error_log($error_message);
        wp_die($error_message);
    }
}
