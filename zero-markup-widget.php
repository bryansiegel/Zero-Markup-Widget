<?php 
/*
Plugin Name: Zero Markup Widget
Description: Dead simple widget to add Zero Markup to any Widget Area.
Plugin URI: https://bryansiegel.com
Author: Bryan Siegel
Version: 1.0
*/


class Zero_Markup_Widget extends WP_Widget {

	public function __construct() {

		$id = 'zero_markup_widget';

		$title = esc_html__('Zero Markup Widget', 'custom-widget');

		$options = array(
			'classname' => 'zero-markup-widget',
			'description' => esc_html__('Adds clean markup that is not modified by Wordpress', 'custom-widget')
		);

		parent::__construct( $id, $title, $options );
	}


	public function widget( $args, $instance ) {

		$markup = '';

		if ( isset( $instance['markup'] ) ) {

			echo wp_kses_post( $instance['markup'] );

		}

	}

	public function update( $new_instance, $old_instance ) {

		if ( isset( $new_instance['markup'] ) && ! empty( $new_instance['markup'] ) ) {

			$instance['markup'] = $new_instance['markup'];
		}

		return $instance;
	}

	//widget form
	public function form( $instance ) {

		$id = $this->get_field_id( 'markup' );

		$for = $this->get_field_id( 'markup' );

		$name = $this->get_field_name( 'markup');

		$label ='<p>' .  __( 'Markup/text:', 'custom-widget') . '</p>';

		$markup = '<p>' . __('Zero, absolutely zero Wordpress Markup') . '</p>';


		if ( isset( $instance['markup'] ) && ! empty( $instance['markup'] ) ) {

			$markup = $instance['markup'];
		}
		?>

		<p>
			<lable for="<?php echo esc_attr( $for ); ?>"><?php echo esc_html( $label ); ?></lable>
			<textarea class="widefat" id="<?php esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>">
				<?php echo esc_textarea( $markup ); ?>
			</textarea>
		</p>

	<?php }

}
///////

//register widget
function zero_markup_register_widgets() {
	
	register_widget('Zero_Markup_Widget');

}
add_action( 'widgets_init', 'zero_markup_register_widgets');

?>