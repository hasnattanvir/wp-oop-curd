<?php
namespace Linuxbangla\Academy;

class Installer{
    public function run(){
        $this->add_version();
        $this->create_tables();
    }

    public function add_version($value=''){
        $installed = get_option('lb_linuxbanglaacademy_installed');
        if (!$installed) {
            update_option('lb_linuxbanglaacademy_installed', time());
        }
        update_option('lb_linuxbanglaacademy', LB_LINUXBANGLACADEMY_VERSION);
    }

    public static function create_tables() {
        global $wpdb;
    
        $charset_collate = $wpdb->get_charset_collate();
    
        $table_name = $wpdb->prefix . 'ac_addresses';
    
        $schema = "CREATE TABLE IF NOT EXISTS `{$table_name}` (
            `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(100) NOT NULL,
            `address` VARCHAR(255) DEFAULT NULL,
            `email` VARCHAR(100) NOT NULL,
            `phone` VARCHAR(50) DEFAULT NULL,
            `created_by` BIGINT(20) UNSIGNED NOT NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY (`id`)
        ) $charset_collate;";
    
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($schema);
    }
    
    
    
}