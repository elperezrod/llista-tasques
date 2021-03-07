<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if ( !function_exists( 'ardtdw_widgetsetup' ) ) {
function ardtdw_widgetsetup() {
	wp_add_dashboard_widget('ardtdw', 'Llista tasques ', 'ardtdw_widget');
}
add_action('wp_dashboard_setup', 'ardtdw_widgetsetup');
}

if ( !function_exists( 'ardtdw_widgetupdate' ) ) {
function ardtdw_widgetupdate(){
	if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
		if( isset($_POST['guardar']) || wp_verify_nonce( $_POST['confirmar'], 'ardtdw_update_list' ) ) {
			if(isset ($_POST['text'])) {
				update_option(
					'text',
					wp_kses($_POST['text'],
					array(
				    'a' => array(
				        'href' => array(),
				        'target' => array(),
				        'title' => array()
				    ),
				    'em' => array(),
				    'strong' => array(),
				    'b' => array(),
				    'u' => array(),
					)
				),
				'',
				'si'
			);
			}

			if ( isset( $_POST['checkbox'] ) ) {
				$checkbox = $_POST['checkbox'];
			} else {
				$checkbox = '';
			}

			if ( isset( $_POST['position'] ) ) {
				$posicio = $_POST['position'];
			} else {
				$posicio = '';
			}

			if ($checkbox) {
				if (empty($_POST['text'])) { ?>
					<div class="ardtdw-message ardtdw-error">
					<p><?php _e( 'Necesites posar com a minim una tasca.','dashboard-to-do-list'); ?></p>
				</div>
				<?php
				$checkbox = '';
			} else { ?>
				<div class="ardtdw-message ardtdw-updated">
					<p><?php _e( 'Llista actualitzada i afegida a la web.','dashboard-to-do-list'); ?></p>
				</div>
				<?php
			}
		} else { ?>
			<div class="ardtdw-message ardtdw-updated">
				<p><?php _e( 'Llista actualitzada.','dashboard-to-do-list'); ?></p>
			</div>
			<?php
		}

			update_option('checkbox', absint($checkbox));
			update_option('position', $posicio);

		}
	}
}
}

if ( !function_exists( 'ardtdw_widget' ) ) {
function ardtdw_widget() {
	ardtdw_widgetupdate();
	$callbackURL = get_site_url();
	$TextArea = stripslashes(get_option('text'));
	$CheckBox = get_option('checkbox');
	$Posicio = get_option('position');
	$Posicio = (empty($Posicio) || $Posicio == '0' || $Posicio == '' || $Posicio == 'undefined' ) ? 'right' : get_option('-position');
	?>
	<form action='<?php echo $callbackURL ?>/wp-admin/index.php' method='post'>

		<textarea name='text' id='text' rows='10'><?php echo esc_html($TextArea) ?></textarea><p/>
		<p class='field-comment'><?php _e( 'Una tasca per linia.','dashboard-to-do-list'); ?></p>
		<p><label for='checkbox'><input name='checkbox' type='checkbox' id='checkbox' value='1' <?php checked( esc_html($CheckBox), true) ?> /><?php _e( 'Mostrar llista a la web.','dashboard-to-do-list'); ?></label></p>
		<input type='submit' value='<?php _e( 'guardar','dashboard-to-do-list'); ?>' class='button-primary' name='guardar'>
		<?php wp_nonce_field( 'ardtdw_update_list', 'confirmar' ); ?>
	</form>
	<?php
}
}

if (get_option('checkbox') && get_option('text')) {
	if ( !function_exists( 'ardtdw_widgethtml' ) ) {
	function ardtdw_widgethtml() {
		if( current_user_can('administrator') ) {
		ardtdw_widget_html();
	}
	}
	add_action('wp_footer', 'ardtdw_widgethtml');
}
}
