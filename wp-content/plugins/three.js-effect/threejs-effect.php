<?php
/**
 * Plugin Name: Three.js Effect
 * Description: Custom shortcode for Three.js effect.
 * Version: 1.0
 * Author: Your Name
 */

if ( ! defined('ABSPATH') ) exit;

// Register shortcode
function threejs_effect_shortcode() {
    // This is what will be output when shortcode runs
    return '<div id="container"></div>';
}
add_shortcode('threejs-effect', 'threejs_effect_shortcode');

// Enqueue three.js script
function threejs_enqueue_scripts() {
    // Load Three.js from CDN
    wp_enqueue_script(
        'threejs',
        'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js',
        array(), null, true
    );

    wp_enqueue_script(
        'GLTFLoader',
        'https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/loaders/GLTFLoader.js',
        array(), null, true
    );

    wp_enqueue_script(
        'OrbitControls',
        'https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js',
        array(), null, true
    );

    // Your custom script (place in plugin /assets folder)
    wp_enqueue_script(
        'threejs-custom',
        plugin_dir_url(__FILE__) . 'assets/threejs-custom.js',
        array('threejs'),
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'threejs_enqueue_scripts');
