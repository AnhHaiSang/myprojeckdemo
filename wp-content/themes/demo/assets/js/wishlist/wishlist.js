jQuery(document).ready(function () {

      jQuery('.wishlist-button').on('click', function (e) {
        // Browse wishlist
        jQuery(this).addClass('loading')
        jQuery(this).parent().find('.fa-heart').addClass('added')

        // Delete or add item (only one of both is present).
        jQuery(this).parent().find('.delete_item').click()
        jQuery(this).parent().find('.add_to_wishlist').click()

        e.preventDefault()
      })
  
  var flatsomeAddToWishlist = function () {
    jQuery('.wishlist-button').removeClass('loading')
    jQuery('.wishlist-button').addClass('wishlist-added')

    jQuery.ajax({
      beforeSend: function () {

      },
      complete: function () {

      },
      data: {
        action: 'jws_update_wishlist_count',
      },
      success: function (data) {
        jQuery('i.wishlist-icon').addClass('added')
        if (data == 0) {
          jQuery('i.wishlist-icon').removeAttr('data-icon-label')
        }
        else if (data == 1) {
          jQuery('i.wishlist-icon').attr('data-icon-label', '1')
        }
        else {
          jQuery('i.wishlist-icon').attr('data-icon-label', data)
        }
        setTimeout(function () {
          jQuery('i.wishlist-icon').removeClass('added')
        }, 500)
      },

      url: yith_wcwl_l10n.ajax_url,
    })
  }

  jQuery('body').on('added_to_wishlist removed_from_wishlist', flatsomeAddToWishlist)
})
