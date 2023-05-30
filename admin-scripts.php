<?php
// Enqueue the necessary JavaScript and CSS files for the settings page
function page_progress_bar_admin_enqueue_scripts( $hook ) {
    if ( 'settings_page_page-progress-bar-settings' !== $hook ) {
        return;
    }

    wp_enqueue_script( 'wp-color-picker' );
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'page-progress-bar-admin-script', plugins_url( 'js/page-progress-bar-admin.js', __FILE__ ), array( 'jquery', 'wp-color-picker' ), '1.0', true );
}
add_action( 'admin_enqueue_scripts', 'page_progress_bar_admin_enqueue_scripts' );
