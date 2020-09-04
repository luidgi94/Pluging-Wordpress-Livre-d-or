<?php

function html_form_code(array $postRecu)
{
    echo '<form action="' . esc_url($_SERVER['REQUEST_URI']) . '" method="post">';
    echo '<p>';
    echo 'Your Name (required) <br />';
    echo '<input type="text" name="cf-name" pattern="[a-zA-Z0-9 ]+" value="' . (isset($postRecu["cf-name"]) ? esc_attr($postRecu["cf-name"]) : '') . '" size="40" />';
    echo '</p>';
    echo '<p>';
    echo 'Your Email (required) <br />';
    echo '<input type="email" name="cf-email" value="' . (isset($postRecu["cf-email"]) ? esc_attr($postRecu["cf-email"]) : '') . '" size="40" />';
    echo '</p>';
    echo '<p>';
    echo 'Your Message (required) <br />';
    echo '<textarea rows="10" cols="35" name="cf-message">' . (isset($postRecu["cf-message"]) ? esc_attr($postRecu["cf-message"]) : '') . '</textarea>';
    echo '</p>';
    echo '<p><input type="submit" name="cf-submitted" value="Send"/></p>';
    echo '</form>';
}

function affiche_message($tabMessages)
{
    echo '<h2>Derniers Messages Postés </h2>';
    foreach ($tabMessages as $key => $value) {
        echo '<p>' . $value->getTime() . ' :<br>';
        echo '<b>' . $value->getName() . "</b> (" . $value->getEmail() . ") : " . $value->getMessage() . '</p><br>';
    }
}
