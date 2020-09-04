<?php
/*
Plugin Name: Simple_Livre_Dor
Plugin URI: https://github.com/luidgi94/Pluging-Wordpress-Livre-d-or
Description: Un plugin de création de livre d'or
Version: 0.1
Author: Luidgy Clairboy
Author URI: https://github.com/luidgi94/Pluging-Wordpress-Livre-d-or
License: GPL2
 */
include_once plugin_dir_path(__FILE__) . '/Dao.php';
include_once plugin_dir_path(__FILE__) . '/view.php';

// function hello_world($content)
// {
//     return "<p>" . "Hello Word </p>" . $content;
// }

// add_action('the_content', 'hello_world');

function affiche_livre()
{
    ob_start();
    receive_form();
    html_form_code($_POST);
    affiche_message(Dao::selectMessages());
    return ob_get_clean();
}

function receive_form()
{

    // if the submit button is clicked, send the email
    if (isset($_POST['cf-submitted'])) {
        global $wpdb;

        // sanitize form values
        $name = sanitize_text_field($_POST["cf-name"]);
        $email = sanitize_email($_POST["cf-email"]);
        $message = esc_textarea($_POST["cf-message"]);
        Dao::insertMessage($wpdb->prefix . "livre_dor", new Livre_dor($message, $email, $name));
    }
}

function create_db()
{
    if (!current_user_can('activate_plugins')) {
        return;
    }
    Dao::createTable();
}
function my_plugin_deactivation()
{
    $plugin = isset($_REQUEST['plugin']) ? $_REQUEST['plugin'] : '';
    check_admin_referer("deactivate-plugin_{$plugin}");

    // Deactivation rules here
}
function my_plugin_uninstall()
{
    // Uninstallation stuff here
}

register_uninstall_hook(__FILE__, 'my_plugin_uninstall');

register_activation_hook(__FILE__, 'create_db');

register_deactivation_hook(__FILE__, 'my_plugin_deactivation');

add_shortcode('livre_dor', 'affiche_livre');
