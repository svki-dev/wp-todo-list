<?php
/*
Plugin Name: WP ToDo List
Description: Eine ToDo-Liste für das Backend von WordPress.
Version: 1.0.0
Author: Sven Kilcher (WP Helping Hand)
Author URI: https://wp-helping-hand.com
License: GPLv2 or later
Text Domain: wp-todo-list
*/

class My_Todo_List_Plugin
{
    public function __construct()
    {
        register_activation_hook(__FILE__, array($this, 'activate'));
        // register_deactivation_hook(__FILE__, array($this, 'deactivate'));
        // ANCHOR - Add Admin Page
        add_action('admin_menu', array($this, 'add_admin_page'));
        // ANCHOR - Add Settings Page
        add_action('admin_menu', array($this, 'add_settings_page'));
        require_once plugin_dir_path(__FILE__) . 'pages/todo-page.php';
        // ANCHOR - Add todo list stylesheet
        add_action('admin_enqueue_scripts', array($this, 'wp_todo_list_styles'), 10);
        // ANCHOR - Add todo list script
        add_action('admin_enqueue_scripts', array($this, 'wp_todo_list_script'));
    }

    // ANCHOR - add activationfunctions
    public function activate()
    {
        require_once plugin_dir_path(__FILE__) . 'includes/todo-db.php';
    }

    // ANCHOR - add deactivationfunctions
    // public function deactivate()
    // {
    // }

    // ANCHOR - Render function for admin page
    public function admin_page()
    {
        $page_title = get_bloginfo('name');
        // ANCHOR - HTML for Admin page
?>
        <div class="wrap">
            <h1><?php echo $page_title ?> ToDo-Liste</h1>
            <?php render_todo_page(); ?>
        </div>
    <?php
    }

    // ANCHOR - Function to add admin page
    public function add_admin_page()
    {
        add_menu_page(
            'ToDo-Liste',
            'ToDo-Liste',
            'manage_options',
            'wp-todo-list',
            array($this, 'admin_page'),
            'dashicons-clipboard',
            20
        );
    }

    // ANCHOR - Function to render the settings page
    public function settings_page()
    {
        // ANCHOR - HTML for settings page
    ?>
        <div class="wrap">
            <h1>ToDo-Liste Einstellungen</h1>

        </div>
<?php
    }

    // ANCHOR - Function to add settings page
    public function add_settings_page()
    {
        add_submenu_page(
            'wp-todo-list',
            'Settings',
            'Settings',
            'manage_options',
            'wp-todo-list-settings',
            array($this, 'settings_page')
        );
    }

    //ANCHOR - Function to add stylesheet
    public function wp_todo_list_styles()
    {
        wp_enqueue_style('wp_todo_list_styles', plugin_dir_url(__FILE__) . 'css/style.css', array(), '1.0.0');
    }


    // ANCHOR - Function to add script
    function wp_todo_list_script()
    {
        if (is_admin()) {
            wp_register_script('todo-list-script', plugin_dir_url(__FILE__) . 'js/main.js', array('jquery'), null, true);
            wp_enqueue_script('todo-list-script');
        }
    }
}

new My_Todo_List_Plugin();
