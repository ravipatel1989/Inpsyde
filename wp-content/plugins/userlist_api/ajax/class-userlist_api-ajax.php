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
        $user = json_decode($body);
		$html = '<h4>'.$user->name.' details</h4><br>';
		$html .= '<table>';
		$html .= '<tbody>';
		$html .= '<tr><td>Id:</td><td>'.$user->id.'</td></tr>';
		$html .= '<tr><td>Name:</td><td>'.$user->name.'</td></tr>';
		$html .= '<tr><td>Username:</td><td>'.$user->username.'</td></tr>';
		$html .= '<tr><td>Email:</td><td>'.$user->email.'</td></tr>';
		$html .= '<tr><td colspan="2"><strong>Address</strong></td></tr>';
		$html .= '<tr><td>Street:</td><td>'.$user->address->street.'</td></tr>
					<tr><td>Suite:</td><td>'.$user->address->suite.'</td></tr>
					<tr><td>City:</td><td>'.$user->address->city.'</td></tr>
					<tr><td>Zipcode:</td><td>'.$user->address->zipcode.'</td></tr>
					<tr><td>Latitude:</td><td>'.$user->address->geo->lat.'</td></tr>
					<tr><td>Longitude:</td><td>'.$user->address->geo->lng.'</td></tr>
				';
		$html .= '<tr><td>Phone:</td><td>'.$user->phone.'</td></tr>';
		$html .= '<tr><td>Website:</td><td>'.$user->website.'</td></tr>';
		$html .= '<tr><td colspan="2"><strong>company</strong></td></tr>';
		$html .= '<tr><td>Name:</td><td>'.$user->company->name.'</td></tr>
				  	<tr><td>CatchPhase:</td><td>'.$user->company->catchPhrase.'</td></tr>
					<tr><td>bs:</td><td>'.$user->company->bs.'</td></tr>
				';
		$html .= '</tbody>';
		$html .= '</table>';
        echo $html;
		die;
    }
}
