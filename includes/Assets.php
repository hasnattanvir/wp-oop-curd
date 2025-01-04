<?php
namespace Linuxbangla\Academy;

class Assets{

    function __construct(){
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets'] );
        add_action('admin_enqueue_scripts', [$this, 'enqueue_assets']);

    }

    public function get_scripts(){
        return[
            'academy-script' => [
                'src'        => LB_LINUXBANGLACADEMY_ASSETS.'/js/frontend.js',
                'version'    => filemtime(LB_LINUXBANGLACADEMY_PATH.'/assets/js/frontend.js'),
                'deps'=>['jquery']
            ]
        ];
    }

    public function get_styles(){
        return[
            'academy-style' => [
                'src'       => LB_LINUXBANGLACADEMY_ASSETS.'/css/frontend.css',
                'version'   => filemtime(LB_LINUXBANGLACADEMY_PATH.'/assets/css/frontend.css'),
            ],

            'academy-admin-style' => [
                'src'       => LB_LINUXBANGLACADEMY_ASSETS.'/css/admin.css',
                'version'   => filemtime(LB_LINUXBANGLACADEMY_PATH.'/assets/css/admin.css'),
            ],
        ];
    }


    public function enqueue_assets(){

        $scripts = $this->get_scripts();

        foreach($scripts as $handle => $script){
            $deps = isset($script['deps']) ? $script['deps'] : false;
            wp_register_script( $handle, $script['src'], $deps, $script['version'], true );
        }


        
        $styles = $this->get_styles();

        foreach($styles as $handle => $style){
            $deps = isset($style['deps']) ? $style['deps'] : false;
            wp_register_style( $handle, $style['src'], $deps, $style['version']);
        }

        
        // wp_register_script( 'academy-script', LB_LINUXBANGLACADEMY_ASSETS.'/js/frontend.js', false, filemtime(LB_LINUXBANGLACADEMY_PATH.'/assets/js/frontend.js'), true );
        // wp_register_style( 'academy-style', LB_LINUXBANGLACADEMY_ASSETS.'/css/frontend.css', false, filemtime(LB_LINUXBANGLACADEMY_PATH.'/assets/css/frontend.css'), true );

        // wp_enqueue_script('academy-script');
        // wp_enqueue_style('academy-style');
        
    }

}