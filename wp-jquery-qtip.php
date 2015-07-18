<?php
/*
Plugin Name: WP jQuery qTip
Plugin URI: http://www.dougparling.org/
Description: WP jQuery qTip for Wordpress is a plugin that uses qTip v1.0 and v2.0  to display nice looking, user friendly tooltips. Colors and position are easily changeable. Based on JR qTip for WordPress by Jacob Ras
Version: 1.9.0
Author: Doug Sparling
Author URI: http://www.dougsparling.org

    Copyright 2013-2015 Doug Sparling (email : doug@kl93.com)
    Copyright 2009  Jacob Ras    (email : info@jacobras.nl)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

function wp_jquery_qtip() {

	$wp_jquery_qtip = get_option( 'wp_jquery_qtip' );

	if ( $wp_jquery_qtip['enable_qtip'] == 'on' ) {

		if ( $wp_jquery_qtip['tooltip_version'] == 1 ) {
			wp_register_script( 'jquery.qtip', plugins_url( 'js/jquery.qtip-1.0.0-rc3.min.js', __FILE__ ) );
			wp_enqueue_script( 'jquery.qtip', array( 'jquery' ) );

			wp_register_script( 'wp_jquery_qtip_tooltip', plugins_url( 'js/wp_jquery_qtip_tooltip.js', __FILE__ ) );
			wp_enqueue_script( 'wp_jquery_qtip_tooltip', array( 'jquery', 'jquery.qtip' ) );
		} else {
			wp_register_script( 'jquery.qtip', plugins_url( 'js/qTip2/jquery.qtip.min.js', __FILE__ ) );
			wp_enqueue_script( 'jquery.qtip', array('jquery'));

			wp_register_script( 'wp_jquery_qtip_tooltip', plugins_url( 'js/qTip2/wp_jquery_qtip_tooltip.js', __FILE__ ) );
			wp_enqueue_script( 'wp_jquery_qtip_tooltip', array( 'jquery', 'jquery.qtip' ) );

			wp_register_style('jquery.qtip', plugins_url( 'css/qTip2/jquery.qtip.min.css', __FILE__ ) );
			wp_enqueue_style( 'jquery.qtip');
		}

		$params = array(
			'tooltip_version'  => $wp_jquery_qtip['tooltip_version'],
			'tooltip_color'    => $wp_jquery_qtip['tooltip_color'], // Style
			'tooltip_target'   =>  $wp_jquery_qtip['tooltip_target'],
			'tooltip_position' => $wp_jquery_qtip['tooltip_position']
		);

		wp_localize_script( 'wp_jquery_qtip_tooltip', 'wp_jquery_qtip_params', $params );

	}
}


function wp_jquery_qtip_admin() { ?>

    <div class="wrap">
        <!--<a href="http://www.dougsparling.org"><img src="http://www.dougsparling.org/logo-32.png" width="32" height="32" style="float:left;height:32px;margin:14px 6px 0 6px;width:32px;" alt="" /></a>-->
        <h2>WP jQuery qTip Options</h2>

        <?php if( isset( $_POST['wp_jquery_qtip_hidden'] ) && $_POST['wp_jquery_qtip_hidden'] == 'Y' ) {
            if ( isset( $_POST['wp_jquery_qtip_enable_qtip'] ) ) {
                $wp_jquery_qtip['enable_qtip'] = $_POST['wp_jquery_qtip_enable_qtip']; // 'on'
            } else {
                $wp_jquery_qtip['enable_qtip'] = '';
            }
            $wp_jquery_qtip['tooltip_version'] = $_POST['wp_jquery_qtip_tooltip_version'];
            $wp_jquery_qtip['tooltip_color'] = $_POST['wp_jquery_qtip_tooltip_color'];
            $wp_jquery_qtip['tooltip_target'] = $_POST['wp_jquery_qtip_tooltip_target'];
            $wp_jquery_qtip['tooltip_position'] = $_POST['wp_jquery_qtip_tooltip_position'];
            update_option('wp_jquery_qtip', $wp_jquery_qtip);
        ?>
            <div class="updated"><p><strong><?php _e( 'Options saved.' ); ?></strong></p></div>
        <?php
        } else {
            $wp_jquery_qtip = get_option('wp_jquery_qtip');
        } ?>

        <div class="postbox-container" style="width:100%;">
            <div class="metabox-holder">	
                <form action="" method="post">
                <input type="hidden" name="wp_jquery_qtip_hidden" value="Y" />
                    <div class="postbox">
                        <h3><span>Settings for WP jQuery qTip</span></h3>
                        <div class="inside">
                            <table class="form-table">

                                <tr>
                                    <th valign="top">
                                        <label>Enable WP jQuery qTip:</label>
                                    </th>
                                    <td valign="top">
                                        <input type="checkbox" name="wp_jquery_qtip_enable_qtip" <?php if ( $wp_jquery_qtip['enable_qtip'] ) { echo 'checked="checked"'; } ?> />
                                    </td>
                                </tr>

								<tr>
									<th valign="top">
										<label>qTip version</label>
									</th>
									<td valign="top">
										<select name="wp_jquery_qtip_tooltip_version">
											<option <?php if( $wp_jquery_qtip['tooltip_version'] == 1 ) { echo 'selected="selected"'; } ?> value="1">1&nbsp;&nbsp;&nbsp;</option>
											<option <?php if( $wp_jquery_qtip['tooltip_version'] == 2 ) { echo 'selected="selected"'; } ?> value="2">2&nbsp;&nbsp;&nbsp;</option>
										</select>
									</td>
								</tr>

                                <tr>
                                    <th valign="top">
                                        <label>Tooltip style:</label>
                                    </th>
                                    <td valign="top">
                                        <select name="wp_jquery_qtip_tooltip_color">
                                            <option <?php if( $wp_jquery_qtip['tooltip_color'] == 'cream' ) { echo 'selected="selected"'; } ?> value="cream">Cream&nbsp;&nbsp;&nbsp;</option>
                                            <option <?php if( $wp_jquery_qtip['tooltip_color'] == 'dark' ) { echo 'selected="selected"'; } ?> value="dark">Dark&nbsp;&nbsp;&nbsp;</option>
                                            <option <?php if( $wp_jquery_qtip['tooltip_color'] == 'green' ) { echo 'selected="selected"'; } ?> value="green">Green&nbsp;&nbsp;&nbsp;</option>
                                            <option <?php if( $wp_jquery_qtip['tooltip_color'] == 'light' ) { echo 'selected="selected"'; } ?> value="light">Light&nbsp;&nbsp;&nbsp;</option>
                                            <option <?php if( $wp_jquery_qtip['tooltip_color'] == 'red' ) { echo 'selected="selected"'; } ?> value="red">Red&nbsp;&nbsp;&nbsp;</option>
                                            <option <?php if( $wp_jquery_qtip['tooltip_color'] == 'blue' ) { echo 'selected="selected"'; } ?> value="blue">Blue&nbsp;&nbsp;&nbsp;</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <th valign="top">
                                        <label>Tooltip target position:</label>
                                    </th>
                                    <td valign="top">
                                        <select name="wp_jquery_qtip_tooltip_target">
                                            <?php

                                            $aTooltipPositions = array( 'topLeft', 'topMiddle', 'topRight', 'rightTop', 'rightMiddle', 'rightBottom', 'bottomRight', 'bottomMiddle', 'bottomLeft', 'leftBottom', 'leftMiddle', 'leftTop' );

                                            $i = 0;
                                            while ( $i < count( $aTooltipPositions ) ) {
                                                echo '<option ';
                                                if ( $wp_jquery_qtip['tooltip_target'] == $aTooltipPositions[$i] ) { echo 'selected="selected" '; }
                                                echo 'value="' . $aTooltipPositions[$i] . '">' . $aTooltipPositions[$i] . '&nbsp;&nbsp;&nbsp;</option>' . "\n";
                                                $i++;
                                            }

                                            ?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <th valign="top">
                                        <label>Tooltip position:</label>
                                    </th>
                                    <td valign="top">
                                        <select name="wp_jquery_qtip_tooltip_position">
                                            <?php

                                            $aTooltipPositions = array('topLeft', 'topMiddle', 'topRight', 'rightTop', 'rightMiddle', 'rightBottom', 'bottomRight', 'bottomMiddle', 'bottomLeft', 'leftBottom', 'leftMiddle', 'leftTop');
                                            $i = 0;
                                            while ( $i < count( $aTooltipPositions ) ) {
                                                echo '<option ';
                                                if ( $wp_jquery_qtip['tooltip_position'] == $aTooltipPositions[$i] ) { echo 'selected="selected" '; }
                                                echo 'value="' . $aTooltipPositions[$i] . '">' . $aTooltipPositions[$i] . '&nbsp;&nbsp;&nbsp;</option>' . "\n";
                                                $i++;
                                            }

                                            ?>
                                        </select>
                                    </td>
                                </tr>

                            </table>

                            <div style="margin:20px 0 12px 0;padding-left:12px;"><input type="submit" class="button-primary" name="submit" value="Save settings" /></div>
                        </div>
                    </div>

                    <div class="postbox">
                    <h3>Tooltip style &amp; positioning preview:</h3>
                    <p style="text-align:center;">
                        <img src="<?php echo get_bloginfo('url') . '/wp-content/plugins/wp-jquery-qtip/qtip_positioning.jpg'; ?>" />
                    </p>

                    <p style="text-align:center;">
                        <img src="<?php echo get_bloginfo('url') . '/wp-content/plugins/wp-jquery-qtip/qtip_colors_preview.gif'; ?>" />
                    </p>
                    </div>

                </form>
            </div>
        </div>

    </div>

<?php }

//function wp_jquery_qtip_menu() {
//    add_options_page('WP jQuery qTip', 'WP jQuery qTip', 'manage_options', 'wp-jquery-qtip.php', 'wp_jquery_qtip_admin');
//}

// default settings
$wp_jquery_qtip = array();
$wp_jquery_qtip['enable_qtip']       = 'on';
$wp_jquery_qtip['tooltip_version']   = 1;
$wp_jquery_qtip['tooltip_color']     = 'cream';
$wp_jquery_qtip['tooltip_target']    = 'bottomMiddle';
$wp_jquery_qtip['tooltip_position']  = 'topMiddle';
add_option('wp_jquery_qtip', $wp_jquery_qtip);
add_action('wp_enqueue_scripts', 'wp_jquery_qtip');
//add_action('admin_menu', 'wp_jquery_qtip_menu');

add_action('admin_menu', 'my_admin_add_page');
function my_admin_add_page() {
    global $my_admin_page;
    $my_admin_page = add_options_page(__('WP jQuery qTip', 'map'), __('WP jQuery qTip', 'map'), 'manage_options', 'map', 'wp_jquery_qtip_admin');

    // Adds my_help_tab when my_admin_page loads
    add_action('load-' . $my_admin_page, 'my_admin_add_help_tab');
}

function my_admin_add_help_tab () {
    global $my_admin_page;
    $screen = get_current_screen();

    /*
     * Check if current screen is My Admin Page
     * Don't add help tab if it's not
     */
    if ( $screen->id != $my_admin_page )
        return;

    // Add my_help_tab if current screen is My Admin Page
    $screen->add_help_tab( array(
        'id'      => 'wp_jquery_qtip_help_tab',
        'title'   => __('WP jQuery qTip - Help'),
        'content' => '<p>' . __( 'WP jQuery qTip is a WordPress plugin that acts as a wrapper for the jQuery qTip v1.0 plugin written by Craig Thompson.' ) . '</p><p>' . __( 'WP jQuery qTip includes the jQuery needed to produce equivelent functionality of the Title Attribute and Image Maps demos located on the qTip website (http://http://craigsworks.com/projects/qtip/demos/). For now, if you require other functionality from the qTip plugin, you may modify the js/wp-jquery-qtip-tooltip.js file to suit your needs. I may make this more robust in a future version of this plugin.' ) . '</p><p>' . __( 'Examples...' ) . '</p><p>' . __( 'Title Attribute:<br />&lt;a href="#" title="That sounds familiar...">Q-Tip&lt;/a>' ) . '</p><p>' . __( 'Image Maps:<br />&lt;map name="planetmap"><br />&nbsp;&nbsp;&nbsp;&nbsp;&lt;area shape="rect" coords="0,0,82,126" alt="Sun" /><br />&lt;/map>' ) . '</p>',
    ) );
}
?>
