<?php
namespace Linuxbangla\Academy\Admin;

/**
 * Addressbook handler class
 */
class Addressbook{
    public $errors = [];

    /**
     * Plugin page handler
     *
     * @return void
     */
    public function plugin_page(){
        
     $action = isset($_GET['action']) ? $_GET['action']:'list';

     switch($action){
        case 'new':
            $template = __DIR__.'/views/address-new.php';
            break;
        case 'edit':
            $template = __DIR__.'/views/address-edit.php';
            break;
        case 'view':
            $template = __DIR__.'/views/address-view.php';
            break;
        default:
            $template = __DIR__.'/views/address-list.php';
            break;
     }

     if(file_exists($template)){
        include $template;
     }

    }


    /**
     * Handle the form
     *
     * @return void
     */
    public function form_handler(){

        if(!isset($_POST['submit_address'])){
            return;
        }

        if(!wp_verify_nonce( $_POST['_wpnonce'], 'new-address' )){
            wp_die('are you cheating NONCE ?');
        }

        if(!current_user_can( 'manage_options' )){
            wp_die('are you cheating USER?');
        }

        $name = isset($_POST['name'])? sanitize_text_field( $_POST['name'] ):'';
        $address = isset($_POST['address'])? sanitize_textarea_field( $_POST['address'] ):'';
        $email = isset($_POST['email'])? sanitize_text_field( $_POST['email'] ):'';
        $phone = isset($_POST['phone'])? sanitize_text_field( $_POST['phone'] ):'';

        if(empty($name)){
            $this->errors['name'] = __('Please provide a name','linuxbangla-academy'); 
        }
        if(empty($phone)){
            $this->errors['phone'] = __('Please provide a phone','linuxbangla-academy'); 
        }
        if(empty($email)){
            $this->errors['email'] = __('Please provide a email','linuxbangla-academy'); 
        }
        if(empty($address)){
            $this->errors['address'] = __('Please provide a address','linuxbangla-academy'); 
        }

        if(!empty($this->errors)){
            return;
        }



        $insert_id = \lb_ac_insert_address([
            'name'    => $name,
            'address' => $address,
            'email'   => $email,
            'phone'   => $phone
        ]);
        


        if (is_wp_error($insert_id)) {
            wp_die($insert_id->get_error_message());
        } else {
            // Redirect to a success page or display a success message
            $redirected_to = admin_url('admin.php?page=linuxbangla-academy&inserted=true');
            wp_redirect($redirected_to);
            exit;
        }
        
        // wd_ac_insert_address();
        // $test = lb_ac_insert_address();
        // echo '<pre>';
        // var_dump($test);
        // echo '</pre>';

        // var_dump($_POST);
        // exit;
    }


}