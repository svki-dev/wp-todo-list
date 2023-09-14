<?php

/**
 * Plugin Name: WP ToDo List
 * Description: A ToDo list for the WordPress backend.
 * Version: 1.0.0
 * Author: Sven Kilcher (WP Helping Hand)
 * Author URI: https://wp-helping-hand.com
 * License: GPLv2 or later
 * Text Domain: wp-todo-list
 */

namespace MyTodoListPlugin;

if (!defined('ABSPATH')) {
    exit; // Block direct access to the file
}

class Plugin
{
    public function __construct()
    {
        // Register activation hook
        require_once plugin_dir_path(__FILE__) . 'includes/todo-db.php';
        register_activation_hook(__FILE__, 'create_todo_table');



        // Add admin page
        add_action('admin_menu', array($this, 'add_admin_page'));
        require_once plugin_dir_path(__FILE__) . 'pages/todo-page.php';

        // Enqueue todo list stylesheet and script
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
    }

    // Render function for admin page
    public function admin_page()
    {
        $page_title = get_bloginfo('name');
        // HTML for Admin page
?>
        <div class="wrap">
            <h1><?php echo $page_title; ?> ToDo List</h1>
            <?php render_todo_page(); ?>
        </div>
<?php
    }

    // Function to add admin page
    public function add_admin_page()
    {
        // Add menu page for ToDo list
        add_menu_page(
            'ToDo List',
            'ToDo List',
            'manage_options',
            'wp-todo-list',
            array($this, 'admin_page'),
            'dashicons-clipboard',
            20
        );
    }

    // Function to enqueue admin assets
    public function enqueue_admin_assets()
    {
        if (is_admin()) {
            // Enqueue ToDo list stylesheet
            wp_enqueue_style('wp_todo_list_styles', plugin_dir_url(__FILE__) . 'css/style.css', array(), '1.0.0');

            // Enqueue ToDo list script
            wp_enqueue_script('todo-list-script', plugin_dir_url(__FILE__) . 'js/main.js', array('jquery'), null, true);
        }
    }
}

// Load the plugin
add_action('plugins_loaded', function () {
    new Plugin();
});
