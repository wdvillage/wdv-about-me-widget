<?php
/*-----------------------------------------------------------------------------------*/
/*	WDV About Me Widget Class
/*-----------------------------------------------------------------------------------*/

class WDV_About_Me_Widget extends WP_Widget { 
    /**
    * Register widget with WordPress.
    */
    public function __construct() {
        $this->defaults = array(
            'title' => '',
            'image' => '',
            'alt'  => '',
            'name'  => '',
            'profession'  => '',
            'description'  => '',
        );
        
        $widget_ops = array( 'classname'   => 'wdv_about_me_widget', 'description' => __( 'Add About Me widget', 'wdv-about-me-widget' ));
       
        parent::__construct( 'wdv_about_me_widget', __( 'WDV: About Me widget', 'wdv-about-me-widget' ), $widget_ops );

        function wdv_image_uploader() {

                if ( ! did_action( 'wp_enqueue_media' ) ) {
                        wp_enqueue_media();
                }
                wp_enqueue_script( 'wdv_image_uploader_script', WDV_ABOUT_ME_WIDGET_URL.'js/main.js', array('jquery'), null, false );
                wp_enqueue_style( 'wdv_image_uploader_style' , WDV_ABOUT_ME_WIDGET_URL. '/css/style.css');
        } 
        add_action( 'admin_enqueue_scripts', 'wdv_image_uploader' );      
}
  	
	function widget( $args, $instance ) {
        $instance = wp_parse_args( (array) $instance, $this->defaults );

        echo $args['before_widget'];

            if ( ! empty( $instance['title'] ) )
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $args['after_title'];

            echo ( ! empty( $instance['image'] ) ) ? '<img src="' . $instance['image'] . '" alt="' . $instance['alt'] . '" />' : '';       
            echo ( ! empty( $instance['name'] ) ) ? '<div class="about-name">' . $instance['name'] .'</div>' : '';
            echo ( ! empty( $instance['profession'] ) ) ? '<div class="about-profession">'  . $instance['profession'] .'</div>' : '';
            echo ( ! empty( $instance['description'] ) ) ? '<div class="about-description">' . $instance['description'] .'</div>' : '';

        echo $args['after_widget'];
	}

	
	function update( $new_instance, $old_instance ) {

        $new_instance['title']  = strip_tags( $new_instance['title'] );
        $new_instance['image']  = esc_url_raw( $new_instance['image'] );
        $new_instance['alt']   = strip_tags( $new_instance['alt'] );
        $new_instance['name']   = strip_tags( $new_instance['name'] );
        $new_instance['profession']   = strip_tags( $new_instance['profession'] ); 
        $new_instance['description']   = esc_textarea( $new_instance['description'] );
        return $new_instance;
	}

        
	function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, $this->defaults );
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title', 'wdv-about-me-widget' ); ?>:</label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
        </p>
          
    
        <div class="wdv-image-container">        

            <label for="<?php echo esc_attr($this->get_field_id( 'image' )); ?>"><?php esc_html_e( 'Image', 'wdv-about-me-widget' ); ?>:</label>
            <div class="wdv-media-container" >

                <div class="wdv-media-inner">
                    <?php $img_style = ( $instance['image'] != '' ) ? '' : 'style="display:none; float: left"'; ?>
                    <img id="<?php echo esc_attr($this->get_field_id( 'image' )); ?>-preview" src="<?php echo esc_url( $instance['image'] ); ?>" <?php echo esc_attr($img_style); ?> <?php $no_img_style = esc_attr(( $instance['image'] != '' ) ? 'style="display:none"' : ''); ?> />        
                    <span class="no-image" id="<?php echo esc_attr($this->get_field_id( 'image' )); ?>-noimg" <?php echo esc_attr($no_img_style); ?>><?php esc_html_e( 'No image selected', 'wdv-about-me-widget' ); ?></span>
                <div class="wdv-empty"></div>
                </div>
                
                <input type="text" id="<?php echo esc_attr($this->get_field_id( 'image' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'image' )); ?>" value="<?php echo esc_attr( $instance['image'] ); ?>" class="wdv-media-url" />
                <p>
                    <input type="button" value="<?php echo esc_html_e( 'Remove Image', 'wdv-about-me-widget' ); ?>" class="button wdv-media-remove" id="<?php echo esc_attr($this->get_field_id( 'image' )); ?>-remove" <?php echo esc_attr($img_style); ?> />
                    <input type="button" value="<?php echo esc_html_e( 'Select Image', 'wdv-about-me-widget' ); ?>" class="button wdv-media-upload" id="<?php echo esc_attr($this->get_field_id( 'image' )); ?>-button" />
                </p>
            </div>

        </div>


        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'alt' )); ?>"><?php esc_html_e( 'Alternative text for image', 'wdv-about-me-widget' ); ?>:</label>
            <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'alt' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'alt' )); ?>" value="<?php echo esc_attr( $instance['alt'] ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'name' )); ?>"><?php esc_html_e( 'Name', 'wdv-about-me-widget' ); ?>:</label>
            <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'name' )); ?>" value="<?php echo esc_attr( $instance['name'] ); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'profession' )); ?>"><?php esc_html_e( 'Profession', 'wdv-about-me-widget' ); ?>:</label>
            <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'profession' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'profession' )); ?>" value="<?php echo esc_attr( $instance['profession'] ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'description' )); ?>"><?php esc_html_e(__( 'Description:', 'wdv-about-me-widget' )); ?></label>
            <textarea class="widefat" rows="6" cols="20" id="<?php echo esc_attr($this->get_field_id( 'description' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'description' )); ?>" type="text" ><?php echo esc_attr( $instance['description'] ); ?></textarea>
        </p>  
        
        <?php
	}
}


add_action( 'plugins_loaded', 'wdv_load_about_me_widget_text_domain' );


/* Load text domain */
function wdv_load_about_me_widget_text_domain() {
  load_plugin_textdomain( 'wdv-about-me-widget', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}