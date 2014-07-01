<?php
/*
	Plugin Name: Kuehl Social Media Icons Widget
	Description: A widget for adding your social media icons in a sidebar.
	Plugin URI: https://gist.github.com/JLeuze/475bdd6bd6095b7bdf7c
	Author: Julie Kuehl
	Author URI: http://www.juliekuehl.com/
	License: GPL2
	Version: 1.0
*/

/**
 * Adds Kuehl Social Media Icons widget.
 */
class Kuehl_Social_Media_Icons_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'name', // Base ID
			__('Kuehl Social Media Icons Widget', 'kuehl_social_media_icons_widget'), // Name
			array( 'description' => __( 'A widget for adding social media icons.', 'kuehl_social_media_icons_widget' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$kuehl_social_media_icons = apply_filters( 'widget_title', $instance['kuehl_social_media_icons'] );

		echo $args['before_widget'];
		echo $args['before_title'] . '<span>Hello</span> my name is...' . $args['after_title'];
		if ( ! empty( $kuehl_social_media_icons ) ) {
			echo '<p>' . $kuehl_social_media_icons . '</p>';
		}
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'kuehl_social_media_icons' ] ) ) {
			$kuehl_social_media_icons = $instance[ 'kuehl_social_media_icons' ];
		}
		else {
			$kuehl_social_media_icons = __( 'Twitter', 'kuehl_social_media_icons_widget' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'kuehl_social_media_icons' ); ?>"><?php _e( 'Social Network:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'kuehl_social_media_icons' ); ?>" name="<?php echo $this->get_field_name( 'kuehl_social_media_icons' ); ?>" type="text" value="<?php echo esc_attr( $kuehl_social_media_icons); ?>">
		</p>
	<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['kuehl_social_media_icons'] = ( ! empty( $new_instance['kuehl_social_media_icons'] ) ) ? strip_tags( $new_instance['kuehl_social_media_icons'] ) : '';

		return $instance;
	}

} // class Kuehl_Social_Media_Icons_Widget

// register Kuehl Social Media Icons widget
function kuehl_register_social_media_icons_widget() {
	register_widget( 'Kuehl_Social_Media_Icons_Widget' );
}
add_action( 'widgets_init', 'kuehl_register_social_media_icons_widget' );

/**
 * Adds CSS to style widget
 */
function kuehl_social_media_icons_widget_css() {
	?><style>
		.widget_name {
			background-color: #327ed4;
			border-radius: 30px;
			box-shadow: 0px 1px 5px 0px #666;
			padding: 0 0 30px 0;
			text-align: center;
		}
		.widget-area .widget_name .widget-title,
		.widget_name .widget-title {
			color: #fff;
			font-family: sans-serif;
			font-size: 18px;
			font-weight: normal;
			line-height: 20px;
			margin: 0;
			padding: 15px;
			text-transform: none;
		}
		.widget_name .widget-title span {
			display: block;
			font-size: 36px;
			font-weight: bold;
			line-height: 36px;
			text-transform: uppercase;
		}
		.widget-area .widget_name p,
		.widget_name p {
			background-color: #fff;
			font-family: 'Comic Sans', 'Comic Sans MS', cursive;
			font-size: 26px;
			line-height: 32px;
			margin: 0;
			padding: 40px 10px;
		}
	</style><?php
}
add_action( 'wp_head', 'kuehl_social_media_icons_widget_css' );