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
        return 'hellow form shortcode';
    }
 }