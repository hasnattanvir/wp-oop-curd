<?php
namespace Linuxbangla\Academy;

/**
 * The main class
 */


 class Admin{

    function __construct(){
        $addressbook = new Admin\Addressbook();

        $this->dispatch_actions($addressbook);
        new Admin\Menu($addressbook);
    }

    public function dispatch_actions($addressbook){
        add_action('admin_init', [$addressbook,'form_handler']);
        add_action('admin_post_lb-ac-delete-address',[$addressbook, 'delete_address']);
    }

 }