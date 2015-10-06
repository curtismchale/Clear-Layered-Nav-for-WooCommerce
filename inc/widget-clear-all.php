<?php
class Woo_Clear_All_Widget extends WP_Widget {

	function Woo_Clear_All_Widget() {
		// Instantiate the parent object
		parent::__construct( false, $name = 'Clear All Filters' );
	} // Custom_CTA

	/**
	 * Displays the widget on the frontend of the site
	 *
	 * @since 1.0
	 * @author  SFNdesign, Curtis McHale
	 *
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {
		// Widget output on the frontend
		extract( $args, EXTR_SKIP );

		echo $before_widget;

		$get_array = $_GET;
		$exists = false;
		$matches = array();

		foreach( $get_array as $key => $value ){
			if ( false === $exists ){
				preg_match( '/^filter/', $key, $matches );
				if ( ! empty( $matches ) ){
					$exists = true;
				}
			}
		}

		if ( true === $exists ){
			$filterreset = $_SERVER['REQUEST_URI'];
			$filterreset = strtok($filterreset, '?');
			echo '<ul>';
				echo '<li><a href="'. esc_url( $filterreset ) .'">Clear Filters</a>';
			echo '</ul>';
		}

		echo $after_widget;
	} // widget

	/**
	 * Saves the form on the widget
	 *
	 * @since 1.0
	 * @author  SFNdesign, Curtis McHale
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		return $old_instance;
	} // update

	/**
	 * Displays the form on the widget
	 *
	 * @since 1.0
	 * @author  SFNdesign, Curtis McHale
	 *
	 * @param array $instance
	 * @return string|void
	 *
	 * @uses wp_parse_args()        Parses out the WordPress arguments
	 * @usse get_field_name()       Get the proper name for the field give the string
	 */
	function form( $instance ) {
		?>

		<p>There are no options for this widget</p>
		<?php
	} // form

} // Woo_Clear_All_Widget

add_action( 'widgets_init', create_function( '', 'return register_widget("Woo_Clear_All_Widget");' ));
