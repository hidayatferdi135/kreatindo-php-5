(function($) {
	'use strict';
	// Ajax QuickView
	jQuery(document).ready(function(){
		jQuery('a.quickview').click(function (e) {
			e.preventDefault();
			var self = $(this);
			self.parent().parent().parent().addClass('loading');
		    var productslug = jQuery(this).data('productslug');
		    var url = trucking_ajax.ajaxurl + '?action=trucking_quickview_product&productslug=' + productslug;
		    
	    	jQuery.get(url,function(data,status){
		    	$.magnificPopup.open({
					mainClass: 'apus-mfp-zoom-in',
					items    : {
						src : data,
						type: 'inline'
					}
				});
				// variation
                if ( typeof wc_add_to_cart_variation_params !== 'undefined' ) {
                    $( '.variations_form' ).each( function() {
                        $( this ).wc_variation_form().find('.variations select:eq(0)').change();
                    });
                }
                var config = {
                    infinite: true,
                    arrows: true,
                    dots: true,
                    slidesToShow: 1,
                    slidesToScroll: 1
                };
                $(".quickview-slick").slick( config );
                
				self.parent().parent().parent().removeClass('loading');
		    });
		});
	});
	
	// thumb image
	$('.thumbnails-image-carousel .thumb-link').click(function(e){
		e.preventDefault();
	});

	// review
    $('.woocommerce-review-link').click(function(){
        $('.woocommerce-tabs a[href=#tabs-list-reviews]').click();
        $('html, body').animate({
            scrollTop: $("#reviews").offset().top
        }, 1000);
        return false;
    });
    
    if ( $('.comment-form-rating').length > 0 ) {
        var $star = $('.comment-form-rating .filled');
        var $review = $('#rating');
        $star.find('li').on('mouseover',
            function () {
                $(this).nextAll().find('span').removeClass('fa-star').addClass('fa-star-o');
                $(this).prevAll().find('span').removeClass('fa-star-o').addClass('fa-star');
                $(this).find('span').removeClass('fa-star-o').addClass('fa-star');
                $review.val($(this).index() + 1);
            }
        );
    }

    // accessories
    var truckingAccessories = {
    	init: function() {
    		var self = this;
    		// check box click
    		$('body').on('click', '.accessoriesproducts .accessory-add-product', function() {
    			self.change_event();
			});
			// check all
			self.check_all_items();
    		// add to cart
    		self.add_to_cart();
    	},
    	add_to_cart: function() {
    		var self = this;
    		$('body').on('click', '.add-all-items-to-cart:not(.loading)', function(e){
    			e.preventDefault();
    			var self_this = $(this);
    			self_this.addClass('loading');
				var all_product_ids = self.get_checked_product_ids();

				if( all_product_ids.length === 0 ) {
					var msg = trucking_woo.empty;
				} else {
					for (var i = 0; i < all_product_ids.length; i++ ) {
						$.ajax({
							type: "POST",
							async: false,
							url: trucking_ajax.ajaxurl,
							data: {
								'product_id': all_product_ids[i],
								'action': 'woocommerce_add_to_cart'
							},
							success : function( response ) {
								self.refresh_fragments( response );
							}
						});
					}
					var msg = trucking_woo.success;
				}
				$( '.trucking-wc-message' ).html(msg);
				self_this.removeClass('loading');
			});
    	},
    	change_event: function() {
    		var self = this;
    		$('.accessoriesproducts-wrapper').addClass('loading');
			var total_price = self.get_total_price();
			$.ajax({
				type: "POST",
				async: false,
				url: trucking_ajax.ajaxurl,
				data: { 'action': "trucking_get_total_price", 'data': total_price  },
				success : function( response ) {
					$( 'span.total-price .amount' ).html( response );
					$( 'span.product-count' ).html( self.product_count() );

					var product_ids = self.get_unchecked_product_ids();
					$( '.accessoriesproducts .list-v2' ).each(function() {
						$(this).parent().removeClass('is-disable');
						for (var i = 0; i < product_ids.length; i++ ) {
							if( $(this).hasClass( 'list-v2-'+product_ids[i] ) ) {
								$(this).parent().addClass('is-disable');
							}
						}
					});
				}
			});
			$('.accessoriesproducts-wrapper').removeClass('loading');
    	},
    	check_all_items: function() {
    		var self = this;
    		$('.check-all-items').click(function(){
    			$('.accessory-add-product:checkbox').not(this).prop('checked', this.checked);
    			if ($(this).is(":checked")) {
					$('.accessory-add-product:checkbox').prop('checked', true);  
				} else {
					$('.accessory-add-product:checkbox').prop("checked", false);
				}

				self.change_event();
    		});
    	},
    	// count product
    	product_count: function(){
			var pcount = 0;
			$('.accessoriesproducts .accessory-add-product').each(function() {
				if ($(this).is(':checked')) {
					pcount++;
				}
			});
			return pcount;
		},
		// get total price
		get_total_price(){
			var tprice = 0;
			$('.accessoriesproducts .accessory-add-product').each(function() {
				if( $(this).is(':checked') ) {
					tprice += parseFloat( $(this).data( 'price' ) );
				}
			});
			return tprice;
		},
		// get checked product ids
		get_checked_product_ids: function(){
			var pids = [];
			$('.accessoriesproducts .accessory-add-product').each(function() {
				if( $(this).is(':checked') ) {
					pids.push( $(this).data( 'id' ) );
				}
			});
			return pids;
		},
		// get unchecked product ids
		get_unchecked_product_ids(){
			var pids = [];
			$('.accessoriesproducts .accessory-add-product').each(function() {
				if( ! $(this).is(':checked') ) {
					pids.push( $(this).data( 'id' ) );
				}
			});
			return pids;
		},
		refresh_fragments: function( response ){
			var frags = response.fragments;

			// Block fragments class
			if ( frags ) {
				$.each( frags, function( key ) {
					$( key ).addClass( 'updating' );
				});
			}
			if ( frags ) {
				$.each( frags, function( key, value ) {
					$( key ).replaceWith( value );
				});
			}
		}
    }
    truckingAccessories.init();

})(jQuery)