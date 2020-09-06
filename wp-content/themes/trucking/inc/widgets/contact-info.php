<?php

class Trucking_Widget_Contact_Info extends Apus_Widget {
    public function __construct() {
        parent::__construct(
            'apus_contact_info',
            esc_html__('Apus Contact Info Widget', 'trucking'),
            array( 'description' => esc_html__( 'Show Contact Info', 'trucking' ), )
        );
        $this->widgetName = 'contact_info';
        add_action('admin_enqueue_scripts', array($this, 'scripts'));
    }
    
    public function scripts() {
        wp_enqueue_script( 'apus-upload-image', APUS_THEMER_URL . 'assets/upload.js', array( 'jquery', 'wp-pointer' ), APUS_THEMER_VERSION, true );
    }

    public function getTemplate() {
        $this->template = 'contact_info.php';
    }

    public function widget( $args, $instance ) {
        $this->display($args, $instance);
    }
    
    public function form( $instance ) {
        $defaults = array('phone_icon' => '', 'phone_title' => '', 'phone_number' => '', 'address_icon' => '', 'address_title' => '', 'address_number' => '', 
            'time_icon' => '', 'time_title' => '', 'time_number' => '' );
        $instance = wp_parse_args( (array) $instance, $defaults );
        // Widget admin form
        ?>
        <div class="phone-wrapper">
            <h3><?php echo esc_attr('Phone Contact Info'); ?></h3>
            <label for="<?php echo esc_attr($this->get_field_id( 'phone_icon' )); ?>"><?php esc_html_e( 'Icon:', 'trucking' ); ?></label>
            <div class="screenshot">
                <?php if ( $instance['phone_icon'] ) { ?>
                    <img src="<?php echo esc_url($instance['phone_icon']); ?>" style="max-width:100%" alt=""/>
                <?php } ?>
            </div>
            <input class="widefat upload_image" id="<?php echo esc_attr($this->get_field_id( 'phone_icon' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'phone_icon' )); ?>" type="hidden" value="<?php echo esc_attr($instance['phone_icon']); ?>" />
            <div class="upload_image_action">
                <input type="button" class="button add-image" value="Add">
                <input type="button" class="button remove-image" value="Remove">
            </div>
            <!-- social -->
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'phone_number' )); ?>"><strong><?php esc_html_e('Phone Number:', 'trucking');?></strong></label>
                <input type="text" id="<?php echo esc_attr($this->get_field_id( 'phone_number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'phone_number' )); ?>" value="<?php echo esc_attr( $instance['phone_number'] ) ; ?>" class="widefat" />
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'phone_title' )); ?>"><strong><?php esc_html_e('Phone Title:', 'trucking');?></strong></label>
                <input type="text" id="<?php echo esc_attr($this->get_field_id( 'phone_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'phone_title' )); ?>" value="<?php echo esc_attr( $instance['phone_title'] ) ; ?>" class="widefat" />
            </p>
        </div>

        <div class="address-wrapper">
            <h3><?php echo esc_attr('Address Contact Info'); ?></h3>
            <label for="<?php echo esc_attr($this->get_field_id( 'address_icon' )); ?>"><?php esc_html_e( 'Icon:', 'trucking' ); ?></label>
            <div class="screenshot">
                <?php if ( $instance['address_icon'] ) { ?>
                    <img src="<?php echo esc_url($instance['address_icon']); ?>" style="max-width:100%" alt=""/>
                <?php } ?>
            </div>
            <input class="widefat upload_image" id="<?php echo esc_attr($this->get_field_id( 'address_icon' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address_icon' )); ?>" type="hidden" value="<?php echo esc_attr($instance['address_icon']); ?>" />
            <div class="upload_image_action">
                <input type="button" class="button add-image" value="Add">
                <input type="button" class="button remove-image" value="Remove">
            </div>
            <!-- social -->
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'address_number' )); ?>"><strong><?php esc_html_e('Address:', 'trucking');?></strong></label>
                <input type="text" id="<?php echo esc_attr($this->get_field_id( 'address_number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address_number' )); ?>" value="<?php echo esc_attr( $instance['address_number'] ) ; ?>" class="widefat" />
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'address_title' )); ?>"><strong><?php esc_html_e('Address Title:', 'trucking');?></strong></label>
                <input type="text" id="<?php echo esc_attr($this->get_field_id( 'address_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address_title' )); ?>" value="<?php echo esc_attr( $instance['address_title'] ) ; ?>" class="widefat" />
            </p>
        </div>

        <div class="time-wrapper">
            <h3><?php echo esc_attr('Time Contact Info'); ?></h3>
            <label for="<?php echo esc_attr($this->get_field_id( 'time_icon' )); ?>"><?php esc_html_e( 'Icon:', 'trucking' ); ?></label>
            <div class="screenshot">
                <?php if ( $instance['time_icon'] ) { ?>
                    <img src="<?php echo esc_url($instance['time_icon']); ?>" style="max-width:100%" alt=""/>
                <?php } ?>
            </div>
            <input class="widefat upload_image" id="<?php echo esc_attr($this->get_field_id( 'time_icon' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'time_icon' )); ?>" type="hidden" value="<?php echo esc_attr($instance['time_icon']); ?>" />
            <div class="upload_image_action">
                <input type="button" class="button add-image" value="Add">
                <input type="button" class="button remove-image" value="Remove">
            </div>
            <!-- social -->
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'time_number' )); ?>"><strong><?php esc_html_e('Time:', 'trucking');?></strong></label>
                <input type="text" id="<?php echo esc_attr($this->get_field_id( 'time_number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'time_number' )); ?>" value="<?php echo esc_attr( $instance['time_number'] ) ; ?>" class="widefat" />
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'time_title' )); ?>"><strong><?php esc_html_e('Time Title:', 'trucking');?></strong></label>
                <input type="text" id="<?php echo esc_attr($this->get_field_id( 'time_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'time_title' )); ?>" value="<?php echo esc_attr( $instance['time_title'] ) ; ?>" class="widefat" />
            </p>
        </div>
<?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['phone_icon'] = ( ! empty( $new_instance['phone_icon'] ) ) ? strip_tags( $new_instance['phone_icon'] ) : '';
        $instance['phone_title'] = ( ! empty( $new_instance['phone_title'] ) ) ? strip_tags( $new_instance['phone_title'] ) : '';
        $instance['phone_number'] = ( ! empty( $new_instance['phone_number'] ) ) ? strip_tags( $new_instance['phone_number'] ) : '';

        $instance['address_icon'] = ( ! empty( $new_instance['address_icon'] ) ) ? strip_tags( $new_instance['address_icon'] ) : '';
        $instance['address_title'] = ( ! empty( $new_instance['address_title'] ) ) ? strip_tags( $new_instance['address_title'] ) : '';
        $instance['address_number'] = ( ! empty( $new_instance['address_number'] ) ) ? strip_tags( $new_instance['address_number'] ) : '';

        $instance['time_icon'] = ( ! empty( $new_instance['time_icon'] ) ) ? strip_tags( $new_instance['time_icon'] ) : '';
        $instance['time_title'] = ( ! empty( $new_instance['time_title'] ) ) ? strip_tags( $new_instance['time_title'] ) : '';
        $instance['time_number'] = ( ! empty( $new_instance['time_number'] ) ) ? strip_tags( $new_instance['time_number'] ) : '';

        return $instance;
    }
}

register_widget( 'Trucking_Widget_Contact_Info' );