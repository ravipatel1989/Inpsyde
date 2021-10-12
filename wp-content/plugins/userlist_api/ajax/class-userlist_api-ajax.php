<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       www.technocratic.biz
 * @since      1.0.0
 *
 * @package    Userlist_api
 * @subpackage Userlist_api/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Userlist_api
 * @subpackage Userlist_api/public
 * @author     Ravi Patel <ravi005patel@gmail.com>
 */
class Userlist_api_Ajax {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

    public function get_user_by_ajax_function(){
        if ( ! wp_verify_nonce( $_POST['nonce'], 'ajax-nonce' ) ) {
            die( _('Please verify nonce') );
        }
        $user_id = filter_input(INPUT_POST,'user_id');
        $endpoint = USERLIST_ENDPOINT ? USERLIST_ENDPOINT : 'https://jsonplaceholder.typicode.com/';
        $usersendpoing = $endpoint.'users/'.$user_id;
        $request = wp_remote_get( $usersendpoing );

        if( is_wp_error( $request ) ) {
            return false; // Bail early
        }
        $body = wp_remote_retrieve_body( $request );
        echo $body;
        die;
    }
}
