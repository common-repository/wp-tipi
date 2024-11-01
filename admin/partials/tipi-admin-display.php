<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.patricelaurent.net
 * @since      1.0.0
 *
 * @package    Tipi
 * @subpackage Tipi/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h2><?php _e( 'TIPI Gateway Settings', 'wp-tipi' ) ?></h2>
	<?php include_once 'tipi-admin-header.php'; ?>

<div id="poststuff" class="metabox-holder has-right-sidebar">
            <div class="inner-sidebar">
                <div class="postbox">
                    <h3 class="hndle"><span><?php _e( 'About' ) ?></span></h3>
                    <div class="inside">
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <input type="hidden" name="cmd" value="_s-xclick">
                            <input type="hidden" name="hosted_button_id" value="PC7ZCMRQ79AD6">
                            <input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal, le réflexe sécurité pour payer en ligne">
                            <img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
                        </form>

                        <ul>
                            <li><span class="dashicons dashicons-admin-plugins"></span> <a target="_blank" href="https://www.patricelaurent.net/portfolio/e-commerce/tipi-pour-wordpress/">Page du plugin</a></li>
                            <li><span class="dashicons dashicons-admin-home"></span> <a target="_blank" href="https://www.patricelaurent.net/">Site de l'éditeur</a></li>
                            <li><span class="dashicons dashicons-wordpress"></span> <a target="_blank" href="https://wordpress.org/support/plugin/wp-tipi">Forum & Support</a></li>

                            <li><span class="dashicons dashicons-heart"></span> <a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=PC7ZCMRQ79AD6">Don PayPal</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="has-sidebar">
                <div id="post-body-content" class="has-sidebar-content">
					<?php settings_errors(); ?>
                    <div class="meta-box-sortabless">
                        <div class="postbox">
                            <div id="wp-tipi" class="inside">
                                <form action='options.php' method='post'>
							<?php
							settings_fields( 'tipi_gateway_settings_option_group' );
							do_settings_sections( 'tipi-gateway-settings-admin' );
							submit_button();
							?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>

</div>