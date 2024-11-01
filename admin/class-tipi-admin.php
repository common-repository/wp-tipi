<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.patricelaurent.net
 * @since      1.0.0
 *
 * @package    Tipi
 * @subpackage Tipi/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tipi
 * @subpackage Tipi/admin
 * @author     Patrice LAURENT <laurent.patrice@gmail.com>
 */
class Tipi_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	private $tipi_gateway_settings_options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of this plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $tipi_gateway_settings_options ) {

		$this->plugin_name                   = $plugin_name;
		$this->version                       = $version;
		$this->tipi_gateway_settings_options = $tipi_gateway_settings_options;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name,
			plugin_dir_url( __FILE__ ) . 'css/tipi-admin.css',
			array(),
			$this->version,
			'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name,
			plugin_dir_url( __FILE__ ) . 'js/tipi-admin.js',
			array( 'jquery' ),
			$this->version,
			false );

	}

	/**
	 * add_submenu_page ( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '' )
	 */
	public function add_menu_tipi() {
		add_menu_page(
			__( 'TIPI Gateway', 'wp-tipi' ), // page_title
			__( 'TIPI Gateway', 'wp-tipi' ), // menu_title
			'manage_options', // capability
			'tipi-gateway-settings', // menu_slug
			[ $this, 'tipi_options_page' ], // function
			'dashicons-cart', // icon_url
			76 // position
		);
	}

	/**
	 * options page
	 */
	public function tipi_options_page() {
		include_once 'partials/tipi-admin-display.php';
	}

	public function tipi_settings_init() {

		register_setting(
			'tipi_gateway_settings_option_group', // option_group
			'tipi_gateway_settings_option_name', // option_name
			array( $this, 'tipi_gateway_settings_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'tipi_gateway_settings_setting_section', // id
			null, // title
			array($this, 'wp_tipi_callback_section'), // callback
			'tipi-gateway-settings-admin' // page
		);

		add_settings_field(
			'tipi_client_number', // id
			__( 'Enter Your Tipi Client Number', 'wp-tipi' ), // title
			array( $this, 'enter_your_tipi_client_number_0_callback' ), // callback
			'tipi-gateway-settings-admin', // page
			'tipi_gateway_settings_setting_section' // section
		);

		add_settings_field(
			'input_mode_1', // id
			__( 'Input Mode', 'wp-tipi' ), // title
			array( $this, 'input_mode_1_callback' ), // callback
			'tipi-gateway-settings-admin', // page
			'tipi_gateway_settings_setting_section' // section
		);

		add_settings_field(
			'where_to_display_it_2', // id
			__( 'Where to display it ?', 'wp-tipi' ), // title
			array( $this, 'where_to_display_it_2_callback' ), // callback
			'tipi-gateway-settings-admin', // page
			'tipi_gateway_settings_setting_section' // section
		);
		add_settings_field(
			'bootstrap_3', // id
			__( 'Disable plugin css style?', 'wp-tipi' ), // title
			array( $this, 'bootstrap_3_callback' ), // callback
			'tipi-gateway-settings-admin', // page
			'tipi_gateway_settings_setting_section' // section
		);
	}

	public function wp_tipi_callback_section(){
	    ?>
        <h3 class="hndle"><span><?php _e('Settings') ?></span></h3>
        <?php
    }

	public function tipi_gateway_settings_sanitize( $input ) {
		$sanitary_values = array();
		if ( isset( $input['tipi_client_number'] ) ) {
			$sanitary_values['tipi_client_number'] = sanitize_text_field( $input['tipi_client_number'] );
		}

		if ( isset( $input['input_mode_1'] ) ) {
			$sanitary_values['input_mode_1'] = $input['input_mode_1'];
		}

		if ( isset( $input['where_to_display_it_2'] ) ) {
			$sanitary_values['where_to_display_it_2'] = $input['where_to_display_it_2'];
		}

		if ( isset( $input['bootstrap_3'] ) ) {
			$sanitary_values['bootstrap_3'] = $input['bootstrap_3'];
		}

		return $sanitary_values;
	}


	public function enter_your_tipi_client_number_0_callback() {
		printf(
			'<input class="regular-text" type="text" name="tipi_gateway_settings_option_name[tipi_client_number]" id="tipi_client_number" value="%s">',
			isset( $this->tipi_gateway_settings_options['tipi_client_number'] ) ? esc_attr( $this->tipi_gateway_settings_options['tipi_client_number'] ) : ''
		);
	}

	public function input_mode_1_callback() {
		?>
        <select name='tipi_gateway_settings_option_name[input_mode_1]'>
            <option value='T' <?php if ( isset( $this->tipi_gateway_settings_options['input_mode_1'] ) ) {
				selected( $this->tipi_gateway_settings_options['input_mode_1'], 'T' );
			} ?>>Test
            </option>
            <option value='X' <?php if ( isset( $this->tipi_gateway_settings_options['input_mode_1'] ) ) {
				selected( $this->tipi_gateway_settings_options['input_mode_1'], 'X' );
			} ?>>Activation
            </option>
            <option value='M' <?php if ( isset( $this->tipi_gateway_settings_options['input_mode_1'] ) ) {
				selected( $this->tipi_gateway_settings_options['input_mode_1'], 'M' );
			} ?>>Production
            </option>
        </select>
		<?php
	}

	public function where_to_display_it_2_callback() {
		$current = isset( $this->tipi_gateway_settings_options['where_to_display_it_2'] ) ? $this->tipi_gateway_settings_options['where_to_display_it_2'] : 0;
		wp_dropdown_pages(
			array(
				'name'              => 'tipi_gateway_settings_option_name[where_to_display_it_2]',
				'echo'              => 1,
				'show_option_none'  => __( '&mdash; Select &mdash;' ),
				'option_none_value' => '0',
				'selected'          => $current,
			)
		); ?>
		<?php if ( $current && $current > 0 ) { ?>
            <a target="_blank" href="<?php echo get_permalink( $current ) ?>"><?php _e( 'Show' ) ?></a>&nbsp;|
		<?php } ?>
        &nbsp;<a href="<?php echo admin_url( 'post-new.php?post_type=page' ) ?>"><?php _e( 'Add New Page' ) ?></a>

		<?php

	}

	public function bootstrap_3_callback() {
		?>
        <fieldset><?php $checked = ( isset( $this->tipi_gateway_settings_options['bootstrap_3'] ) && 'Yes' === $this->tipi_gateway_settings_options['bootstrap_3'] ) ? 'checked' : ''; ?>
            <label for="bootstrap_3-0"><input type="radio" name="tipi_gateway_settings_option_name[bootstrap_3]"
                                              id="bootstrap_3-0"
                                              value="Yes" <?php echo $checked; ?>> <?php _e( 'Yes' ) ?></label><br>
			<?php $checked = ( !array_key_exists('bootstrap_3',$this->tipi_gateway_settings_options) || 'No' === $this->tipi_gateway_settings_options['bootstrap_3']  ) ? 'checked' : ''; ?>
            <label for="bootstrap_3-1"><input type="radio" name="tipi_gateway_settings_option_name[bootstrap_3]"
                                              id="bootstrap_3-1" value="No" <?php echo $checked; ?>> <?php _e( 'No' ) ?>
            </label></fieldset> <?php
	}

	public function custom_tipi_faq() {

		$labels = array(
			'name'           => _x( 'Tipi FAQs', 'Post Type General Name', 'wp-tipi' ),
			'singular_name'  => _x( 'Tipi FAQ', 'Post Type Singular Name', 'wp-tipi' ),
			'menu_name'      => __( 'Tipi Faqs', 'wp-tipi' ),
			'name_admin_bar' => __( 'Faq Tipi', 'wp-tipi' ),
			'archives'       => __( 'Tipi Faq Archives', 'wp-tipi' ),
			'all_items'      => __( 'All Tipi Faqs', 'wp-tipi' ),
			'add_new_item'   => __( 'Add a FAQ', 'wp-tipi' ),

		);
		$args   = array(
			'label'               => __( 'Tipi FAQ', 'wp-tipi' ),
			'description'         => __( 'Manage Tipi Faq', 'wp-tipi' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'page-attributes', ),
			'hierarchical'        => true,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-format-chat',
			'show_in_admin_bar'   => false,
			'show_in_nav_menus'   => false,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);
		register_post_type( 'tipi_faq', $args );

	}

	public function custom_tipi_objet() {

		$labels = array(
			'name'           => _x( 'Invoices Types', 'Post Type General Name', 'wp-tipi' ),
			'singular_name'  => _x( 'Invoices Type', 'Post Type Singular Name', 'wp-tipi' ),
			'menu_name'      => __( 'Tipi Invoices Types', 'wp-tipi' ),
			'name_admin_bar' => __( 'Invoices Types', 'wp-tipi' ),
			'add_new_item'   => __( 'Add invoice type', 'wp-tipi' ),
		);
		$args   = array(
			'label'               => __( 'Invoices Type', 'wp-tipi' ),
			'description'         => __( 'Custom Invoices Types', 'wp-tipi' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'page-attributes', ),
			'hierarchical'        => true,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-clipboard',
			'show_in_admin_bar'   => false,
			'show_in_nav_menus'   => false,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);
		register_post_type( 'tipi_objet', $args );

	}

	/**
	 * MetaBox for Tipi Objet
	 */
	public function add_meta_boxes() {
		add_meta_box(
			'reference',
			__( 'Reference', 'wp-tipi' ),
			array( $this, 'add_meta_box_callback' ),
			'tipi_objet',
			'normal',
			'high'
		);
	}

	public function add_meta_box_callback( $post ) {
		wp_nonce_field( 'reference_data', 'reference_nonce' );
		echo __( 'Internal Reference', 'wp-tipi' );
		$label    = '<label for="reference">' . __( 'Reference', 'wp-tipi' ) . '</label>';
		$db_value = get_post_meta( $post->ID, 'reference_reference', true );
		$input    = sprintf(
			'<input class="regular-text" id="reference" name="reference" type="text" value="%s">',
			$db_value
		);
		echo '<table class="form-table"><tbody>' . $this->row_format( $label, $input ) . '</tbody></table>';

	}

	public function row_format( $label, $input ) {
		return sprintf(
			'<tr><th scope="row">%s</th><td>%s</td></tr>',
			$label,
			$input
		);
	}

	public function save_post( $post_id ) {
		if ( ! isset( $_POST['reference_nonce'] ) ) {
			return $post_id;
		}

		$nonce = $_POST['reference_nonce'];
		if ( ! wp_verify_nonce( $nonce, 'reference_data' ) ) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		if ( array_key_exists( 'reference', $_POST ) && isset( $_POST['reference'] ) ) {
			$tipi_reference = sanitize_text_field( $_POST['reference'] );
			update_post_meta( $post_id, 'reference_reference', $tipi_reference );
		}
	}

	/**
     * Registers additional links for the plugin on the WP plugin configuration page
     *
	 * @param $links
	 * @param $file
	 *
	 * @return array
	 */
	public static function custom_admin_link($links, $file) {
	    if($file === get_wp_tipi_basename()){
		    $links[] = '<a href="'.admin_url('admin.php?page=tipi-gateway-settings').'">' . __('Settings') . '</a>';
		    $links[] = '<a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=PC7ZCMRQ79AD6">' . __('Donate', 'wp-tipi') . '</a>';
        }
		return $links;
	}

}
