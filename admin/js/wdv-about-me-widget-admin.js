(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

    //Upload Image        
        var _custom_media = true,
            _orig_send_attachment = wp.media.editor.send.attachment;
   
        $(document).on( 'click','.wdv-media-upload', function(e) {
            console.log('insidejs=BBBBBBBBBBBBBBBBBBBBB');
            var button_id           = '#' + jQuery( this ).attr( 'id' ),
                send_attachment_bkp = wp.media.editor.send.attachment,
                button              = jQuery( button_id ),
                id                  = button.attr( 'id' ).replace( '-button', '' );

            _custom_media = true;

            wp.media.editor.send.attachment = function( props, attachment ){

                if ( _custom_media ) {

                    jQuery( '#' + id + '-preview'  ).attr( 'src', attachment.url ).css( 'display', 'block' );
                    jQuery( '#' + id + '-remove'  ).css( 'display', 'inline-block' );
                    jQuery( '#' + id + '-noimg' ).css( 'display', 'none' );
                    jQuery( '#' + id ).val( attachment.url ).trigger( 'change' );

                } else {

                    return _orig_send_attachment.apply( button_id, [props, attachment] );
                }
            };
            wp.media.editor.open($(this));

            return false;
        });   

        //Remove Image
            $(document).on( 'click', '.wdv-media-remove', function(e) {

                var button              = jQuery( this ),
                    id                  = button.attr( 'id' ).replace( '-remove', '' );

                jQuery( '#' + id + '-preview' ).css( 'display', 'none' );
                jQuery( '#' + id + '-noimg' ).css( 'display', 'block' );
                button.css( 'display', 'none' );
                jQuery( '#' + id ).val( '' ).trigger( 'change' );

            });    
        
        
        
        
        
    //Add icon
    //    var faicon=array(
    //         'facebook', 'twitter', 'instagram', 'pinterest-p'   
    //        );
        console.log('geturl=AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA');


    
        $(document).on('click','.btn', function(e){
                       console.log( this.id);
                       var buttonid              ='#icon-input-'+ this.id;
                        $(buttonid).css("display", "block");
        });        
        
        
 /*   $(document).on('click','.btn', function(){
                       //geturl=$('#icon-input').val();
                console.log('CCCCCCCCCCC');
        });   */
    
    
        
    //    });
    
    
    
 	function initColorPicker( widget ) {
                widget.find( '#icon-color-field' ).wpColorPicker( {
				change: _.throttle( function() { // For Customizer
						$(this).trigger( 'change' );
				}, 3000 )
		});
                widget.find( '#icon-bg-color-field' ).wpColorPicker( {
				change: _.throttle( function() { // For Customizer
						$(this).trigger( 'change' );
				}, 3000 )
		});
                widget.find( '#icon-hover-color-field' ).wpColorPicker( {
				change: _.throttle( function() { // For Customizer
						$(this).trigger( 'change' );
				}, 3000 )
		});                
	}

	function onFormUpdate( event, widget ) {
		initColorPicker( widget );
	}

	$( document ).on( 'widget-added widget-updated', onFormUpdate );

	$( document ).ready( function() {
                $( '.widget_wdv_about_me_widget #icon-color-field' ).each( function () {
				initColorPicker( $( this ) );
		} );
                $( '.widget_wdv_about_me_widget #icon-bg-color-field' ).each( function () {
				initColorPicker( $( this ) );
		} );
		$( '.widget_wdv_about_me_widget #icon-hover-color-field' ).each( function () {
				initColorPicker( $( this ) );
		} );
	} );   
    
    
    
    
    
    
    


})( jQuery );
