<?php
/**
* Plugin Name: LinuxBangla Academy
* Plugin URI: https://example.com
* Description: A brief description of your plugin.
* Version: 1.0
* Author: Your Name
* Author URI: https://example.com
* Text Domain: linuxbangla-academy
* License: GPL2
*/

if (!defined('ABSPATH')) {
    exit;   
}
require_once __DIR__ . '/includes/functions.php';
// Autoload other classes
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once __DIR__ . '/vendor/autoload.php';
}


final class LB_LINUXBANGLACADEMY {

    /**
     * Plugin version
     * @var string
     */
    public const VERSION = '1.0';

    /**
     * Constructor
     */
    private function __construct() {
        $this->define_constants();
        register_activation_hook(__FILE__, [$this, 'activate']);
        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    /**
     * Initializes a singleton instance
     * @return \LB_LINUXBANGLACADEMY
     */
    public static function init() {
        static $instance = false;
        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    public function define_constants() {
        define('LB_LINUXBANGLACADEMY_VERSION', self::VERSION);
        define('LB_LINUXBANGLACADEMY_FILE', __FILE__);
        define('LB_LINUXBANGLACADEMY_PATH', __DIR__);
        define('LB_LINUXBANGLACADEMY_URL', plugins_url('', LB_LINUXBANGLACADEMY_FILE));
        define('LB_LINUXBANGLACADEMY_ASSETS', LB_LINUXBANGLACADEMY_URL . '/assets');
    }

    public function init_plugin() {

        new Linuxbangla\Academy\Assets();

        if(is_admin()){
            new Linuxbangla\Academy\Admin();
        }else{
            new Linuxbangla\Academy\Frontend();
        }

        new Linuxbangla\Academy\API();
    }
    /**
     * Do stuff upon plugin activation
     *
     * @return void
     */
    public function activate() {
        $installer = new Linuxbangla\Academy\Installer();
        $installer->run();
    }
}
/**
 * Initializes the main plugin
 *
 * @return \WeDevs_Academy
 */
function linuxbangla_academy() {
    return LB_LINUXBANGLACADEMY::init();
}

// Kick off the plugin
linuxbangla_academy();
