<?php
namespace Linuxbangla\Academy\Admin;

/**
 * The Menu handler class
 */
class Menu {

    public $addressbook;

    function __construct($addressbook) {
        $this->addressbook = $addressbook;
        add_action('admin_menu', [$this, 'admin_menu']);
    }

    public function admin_menu() {
        $parent_slug = 'linuxbangla-academy';
        $capability = 'manage_options';

        $hook = add_menu_page(
            __('Linuxbangla Academy', 'linuxbangla-academy'),
            __('Academy', 'linuxbangla-academy'),
            $capability,
            $parent_slug,
            [$this->addressbook,'plugin_page'],
            'dashicons-welcome-learn-more'
        );

        add_submenu_page($parent_slug, __('Address Book', 'linuxbangla-academy'), __('Address Book', 'linuxbangla-academy'), $capability, $parent_slug, [$this->addressbook,'plugin_page']);

        add_submenu_page($parent_slug, __('Settings', 'linuxbangla-academy'), __('Settings', 'linuxbangla-academy'), $capability, 'linuxbangla-academy-settings', [$this, 'setting_page']);


        add_action( 'admin_head-' . $hook, [$this, 'enqueue_assets']);
    }

    /**
    * Render the plugin page
    *
    * @return void
    */

    // public function addressbook_page() {
    //     $addressbook = new Addressbook();
    //     $addressbook->plugin_page();
    // }

    /**
    * Handles the settings page
    *
    * @return void
    */
    public function setting_page() {
        echo 'This is the Settings page.';
    }


    public function enqueue_assets(){
        wp_enqueue_style( 'academy-admin-style');
    }
    
}
