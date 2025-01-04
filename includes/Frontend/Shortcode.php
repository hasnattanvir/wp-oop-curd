<?php

namespace Linuxbangla\Academy\Frontend;

/**
 * shortcode handler class
 */


 class Shortcode{
    /**
     * Initializer the class
     */
    function __construct(){
        add_shortcode( 'linuxbangla-academy',[$this,'render_shortcode'] );
    }

    /**
     * shortcode handler class
     * @param array $atts
     * @param string $content
     * 
     * @return string
     */

    public function render_shortcode($atts,$content=''){
        // when it's rander it's work, it only for shortcode page not full site
        wp_enqueue_script('academy-script');
        wp_enqueue_style('academy-style');
        return '<div class="linuxbangla-academy">This is Linuxbangla Academy Shortcode</div>';
    }
 }