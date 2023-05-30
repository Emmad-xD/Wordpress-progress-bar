<?php
/*
Plugin Name: Page Progress Bar
Description: Adds a progress bar to indicate the user's progress on the page.
Version: 1.0
Author: Your Name
Author URI: Your Website
*/

// Enqueue the necessary JavaScript and CSS files
function page_progress_bar_enqueue_scripts() {
    wp_enqueue_script( 'page-progress-bar-script', plugins_url( 'js/page-progress-bar.js', __FILE__ ), array( 'jquery' ), '1.0', true );
    wp_enqueue_style( 'page-progress-bar-style', plugins_url( 'css/page-progress-bar.css', __FILE__ ), array(), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'page_progress_bar_enqueue_scripts' );

// Add the progress bar HTML to the footer
function page_progress_bar_add_progress_bar() {
    echo '<div id="page-progress-bar"></div>';
}
add_action( 'wp_footer', 'page_progress_bar_add_progress_bar' );

// Add the settings page
function page_progress_bar_settings_page() {
    add_options_page(
        'Page Progress Bar Settings',
        'Page Progress Bar',
        'manage_options',
        'page-progress-bar-settings',
        'page_progress_bar_render_settings_page'
    );
}
add_action( 'admin_menu', 'page_progress_bar_settings_page' );

// Render the settings page
function page_progress_bar_render_settings_page() {
    ?>
    <div class="wrap">
        <h1>Page Progress Bar Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'page-progress-bar-settings' );
            do_settings_sections( 'page-progress-bar-settings' );
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register settings and fields
function page_progress_bar_register_settings() {
    // Register the settings
    register_setting( 'page-progress-bar-settings', 'page_progress_bar_color' );
    register_setting( 'page-progress-bar-settings', 'page_progress_bar_height' );
    register_setting( 'page-progress-bar-settings', 'page_progress_bar_width' );

    // Add the settings section
    add_settings_section(
        'page-progress-bar-settings-section',
        'Page Progress Bar Settings',
        'page_progress_bar_settings_section_callback',
        'page-progress-bar-settings'
    );

    // Add the color picker field
    add_settings_field(
        'page-progress-bar-color-field',
        'Progress Bar Color',
        'page_progress_bar_color_field_callback',
        'page-progress-bar-settings',
        'page-progress-bar-settings-section'
    );

    // Add the height field
    add_settings_field(
        'page-progress-bar-height-field',
        'Progress Bar Height (in px)',
        'page_progress_bar_height_field_callback',
        'page-progress-bar-settings',
        'page-progress-bar-settings-section'
    );

    // Add the width field
    add_settings_field(
        'page-progress-bar-width-field',
        'Progress Bar Width (in px)',
        'page_progress_bar_width_field_callback',
        'page-progress-bar-settings',
        'page-progress-bar-settings-section'
    );
}
add_action( 'admin_init', 'page_progress_bar_register_settings' );

// Callback function for the settings section
function page_progress_bar_settings_section_callback() {
    echo 'Customize the Page Progress Bar settings below:';
}

// Callback function for the color picker field
function page_progress_bar_color_field_callback() {
    $color = get_option( 'page_progress_bar_color', '#0073aa' );
    echo '<input type="text" name="page_progress_bar_color" value="' . esc_attr( $color ) . '" class="color-picker" data-default-color="#0073aa" />';
}

// Callback function for the height field
function page_progress_bar_height_field_callback() {
    $height = get_option( 'page_progress_bar_height', '5' );
    echo '<input type="number" name="page_progress_bar_height" value="' . esc_attr( $height ) . '" min="1" step="1" />';
}

// Callback function for the width field
function page_progress_bar_width_field_callback() {
    $width = get_option( 'page_progress_bar_width', '0' );
    echo '<input type="number" name="page_progress_bar_width" value="' . esc_attr( $width ) . '" min="0" step="1" />';
}
