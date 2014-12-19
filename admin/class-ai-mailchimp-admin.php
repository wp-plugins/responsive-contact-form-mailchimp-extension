<?php
class AI_MailChimp_Admin {

	protected static $instance = null;

	protected $plugin_screen_hook_suffix = null;

	private function __construct() {

		$plugin = AI_MailChimp::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_slug . '.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );

		add_action( 'admin_init', array( $this, 'ai_me_register_settings') );
		

	}

	
	public static function get_instance() {
	
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}


	public function enqueue_admin_styles() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'assets/css/admin.css', __FILE__ ), array(), AI_MailChimp::VERSION );
		}

	}


	public function enqueue_admin_scripts() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery' ), AI_MailChimp::VERSION );
		}

	}

	
	public function add_plugin_admin_menu() {

		$this->plugin_screen_hook_suffix = add_menu_page(__('AI MailChimp Settings','ai-me-contactform'),__('AI MailChimp Settings','ai-me-contactform'),'manage_options',$this->plugin_slug,array( $this, 'display_plugin_admin_page' ),'');
		
		
	}

	
	public function display_plugin_admin_page() {
		require_once('includes/class-form.php');
		$lists = get_lists();
		include_once( 'views/admin.php' );
	}

	
	public function ai_me_register_settings() {
		
		register_setting( 'ai-me-contactform-settings-group', 'ai_me_contactform_api_key' );
		
		register_setting( 'ai-me-contactform-settings-group', 'aimclists' );


	}

	public function add_action_links( $links ) {

		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_slug ) . '">' . __( 'Settings', $this->plugin_slug ) . '</a>'
			),
			$links
		);

	}

}