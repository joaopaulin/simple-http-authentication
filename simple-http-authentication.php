<?php 
/*
Plugin Name: Simple HTTP Authentication
Plugin URI: https://github.com/joaopaulin/simple-http-authentication/
Description: Offers a simple way for HTTP Authentication, on the whole WordPress installation, based on registered users.
Author: João Paulin
Version: 1.0
Author URI: http://joaopaulin.com.br/
*/

function simple_http_authentication_activation() {

    wp_redirect( admin_url() );
}

register_activation_hook( __FILE__, 'simple_http_authentication_activation' );

function simple_http_authentication() {

    if ( is_wp_error( wp_authenticate( $_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'] ) ) ) {

        header('WWW-Authenticate: Basic realm="' . wp_title( '-', false ) . '"');
        header('HTTP/1.0 401 Unauthorized');

        echo __( 'You need to authenticate with a registered user on WordPress.', 'simple-http-authentication' );

        exit;

    }

}

add_action( 'init', 'simple_http_authentication' );