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

                var button = jQuery( this ),
                    id = button.attr( 'id' ).replace( '-remove', '' );

                jQuery( '#' + id + '-preview' ).css( 'display', 'none' );
                jQuery( '#' + id + '-noimg' ).css( 'display', 'block' );
                button.css( 'display', 'none' );
                jQuery( '#' + id ).val( '' ).trigger( 'change' );

            });    

        //***********************************************************
        //Add input for social icon  
        $(document).on('click','.btn', function(e){
            console.log( 'BTN CLICK!!!!!!!!!!!!!!!'); 
            console.log( this);
            console.log( this.id);
            var btnid=this.id;
            var input              ='#icon-input-'+ this.id;
            
            var parent0=document.getElementById(btnid).parentNode.parentNode.parentNode.parentNode;
            var parent00=document.getElementById(btnid).parentNode.parentNode.parentNode.parentNode.parentNode;
            var parent1=document.getElementById(btnid).parentNode.parentNode.parentNode.parentNode.parentNode.parentNode;
            console.log( 'parentNode0', parent0); 
            console.log( 'parentNode00', parent00); 
            console.log( 'parentNode1', parent1);       
            
            var parent=this.parentNode.parentNode.parentNode.parentNode.parentNode;
            console.log( 'parentNode', parent);   
            
            

            var $div = $(parent);
            //find all attributs for div
            var attributs=$div.attr();  
                    
            console.log( 'ARRAY ATTR', attributs); 
                        
            var widgetId=attributs.id;
            console.log( 'IDDD', widgetId); 
            
            var fullinput='#'+widgetId+' '+input;
            console.log( 'FULLLLL IDDD', fullinput); 
            $(fullinput).css("border", "2px solid red");
                        $(fullinput).css("display", "block");
        });            

        //*********************************************************** 
        //var widgetId=document.getElementById("demo");  
        //$('[id^=customize-control-widget_wdv_about_me-]') 
         //Add color
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


    
    


})( jQuery );




           (function(old) {
                $.fn.attr = function() {
                  if(arguments.length === 0) {
                    if(this.length === 0) {
                      return null;
                    }

                    var obj = {};
                    $.each(this[0].attributes, function() {
                      if(this.specified) {
                        obj[this.name] = this.value;
                      }
                    });
                    return obj;
                  }

                  return old.apply(this, arguments);
                };
              })($.fn.attr);
