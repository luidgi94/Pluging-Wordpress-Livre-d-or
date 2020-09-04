<?php
include_once plugin_dir_path(__FILE__) . '/Livre_dor.php';

class Dao
{
    public static function selectMessages(): array
    {
        global $wpdb;
        $tableMessage = array();
        $query = "SELECT * FROM wp_livre_dor  ORDER BY time DESC LIMIT 5";
        $result = $wpdb->get_results($query);
        foreach ($result as $value) {
            $tableMessage[] = new Livre_dor($value->text, $value->email, $value->name, $value->time);
        }
        return $tableMessage;
    }

    public static function createTable()
    {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . "livre_dor";

        $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        time datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        name tinytext NOT NULL,
        text text NOT NULL,
        email varchar(55) DEFAULT '' NOT NULL,
        PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }

    public static function insertMessage(string $table_name, Livre_dor $livre_dor)
    {
        global $wpdb;

        $version = get_option('my_plugin_version', '1.0');
        $wpdb->query($wpdb->prepare(
            "INSERT INTO $table_name (name, text, email) VALUES ( %s, %s, %s )",
            array(
                $livre_dor->getName(),
                stripslashes_deep($livre_dor->getMessage()),
                $livre_dor->getEmail(),
            )
        ));

    }

}
