<?php
/*
	Plugin Name: Name Widget
	Description: A widget for adding your name in a sidebar.
	Plugin URI: https://gist.github.com/JLeuze/475bdd6bd6095b7bdf7c
	Author: Josh Leuze
	Author URI: http://www.jleuze.com/
	License: GPL2
	Version: 1.0
*/

/**
 * Adds Name widget.
 */
class JL_Name_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'name', // Base ID
			__('Name Widget', 'jl_name_widget'), // Name
			array( 'description' => __( 'A widget for adding your name.', 'jl_name_widget' ), ) // Args
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
		$jl_name = apply_filters( 'widget_title', $instance['jl_name'] );

		echo $args['before_widget'];
		echo $args['before_title'] . '<span>Hello</span> my name is...' . $args['after_title'];
		if ( ! empty( $jl_name ) ) {
			echo '<p>' . $jl_name . '</p>';
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
		if ( isset( $instance[ 'jl_name' ] ) ) {
			$jl_name = $instance[ 'jl_name' ];
		}
		else {
			$jl_name = __( 'Inigo Montoya', 'jl_name_widget' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'jl_name' ); ?>"><?php _e( 'Name:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'jl_name' ); ?>" name="<?php echo $this->get_field_name( 'jl_name' ); ?>" type="text" value="<?php echo esc_attr( $jl_name ); ?>">
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
		$instance['jl_name'] = ( ! empty( $new_instance['jl_name'] ) ) ? strip_tags( $new_instance['jl_name'] ) : '';

		return $instance;
	}

} // class JL_Name_Widget

// register Name widget
function jl_register_name_widget() {
	register_widget( 'JL_Name_Widget' );
}
add_action( 'widgets_init', 'jl_register_name_widget' );

/**
 * Adds CSS to style widget
 */
function jl_name_widget_css() {
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
add_action( 'wp_head', 'jl_name_widget_css' );