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
class Userlist_api_Public {

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

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		
		wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/userlist_api-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'datatable', '//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css', array(), $this->version, 'all' );


	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'datatable', '//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js', array('jquery'), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/userlist_api-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script($this->plugin_name, 'ajax_var', array(
			'url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('ajax-nonce')
		));

	}

	public function custom_url_my_lovely_users_table(){
		$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
		if ( $url_path === 'my-lovely-users-table' ) {
			// load the file if exists
			$load = locate_template('my-lovely-users-table.php', true);
			if ($load) {
				exit(); // just exit if template was found and loaded
			}
		}
	}
	
	public function my_lovely_users_table_title($title){
		$url_path = (string)trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
		if ( $url_path === 'my-lovely-users-table' ) {
			$title['title'] = 'My lovely users';
			return apply_filters( 'my_lovely_users_title_filter', $title );
		}
		return $title;
	}


	public function template_include_my_lovely_users_table($template){
		global $wp;
		$fullUrl = home_url( $wp->request );
		$file_name = 'my-lovely-users-table.php';
		if ( strpos($fullUrl, 'my-lovely-users-table') !== false && locate_template( $file_name ) ) {
			$template = locate_template( $file_name );
		} else if(strpos($fullUrl, 'my-lovely-users-table') !== false) {
			$template = dirname( __FILE__ ) . '/templates/' . $file_name;
		}
		return apply_filters( 'my_lovely_users_table_filter', $template );
	}

	function link_to_header_function() {
		?>
			<a class="btn btn-primary" href="<?php echo home_url('my-lovely-users-table');?>">My lovely users</a>
		<?php
	}
	
}
