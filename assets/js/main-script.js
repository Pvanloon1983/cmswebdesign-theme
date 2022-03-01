jQuery(document).ready(function ($) {
  // // Begin of live search script
  // let searchResultsBox = $('.live-search-results');
  // let timeoutId = 0;
  // $('.main-header-search-bar').keydown(function (e) {
  //   // Check if value input stays the same or not when pressing a key.
  //   $('.main-header-search-bar').on('input', function (e) {
  //     // If input field is empty
  //     if (!$('.main-header-search-bar').val()) {
  //       searchResultsBox.html('');

  //       $('.live-search-results-container').hide();
  //     } else {
  //       // If input field is not empty
  //       $('.live-search-results-container').show();

  //       clearTimeout(timeoutId);

  //       if (!$('.loader-cms').is(':visible')) {
  //         searchResultsBox.html(
  //           '<div style="margin: 15px auto;" class="loader-cms"></div>'
  //         );
  //       }

  //       // Only get and show data after about 300 miliseconds
  //       timeoutId = setTimeout(() => {
  //         getSearchResults();
  //       }, 300);

  //       // Get the search results
  //       function getSearchResults() {
  //         $.when(
  //           // $.getJSON(cmsstarterData.root_url + "/wp-json/wp/v2/telefoon_reparaties?search=" + $('.main-header-search-bar').val()),
  //           $.getJSON(
  //             cmsstarterData.root_url +
  //               '/wp-json/wp/v2/posts?search=' +
  //               $('.main-header-search-bar').val()
  //           ),
  //           $.getJSON(
  //             cmsstarterData.root_url +
  //               '/wp-json/wp/v2/pages?search=' +
  //               $('.main-header-search-bar').val()
  //           )
  //         )
  //           // .then((telreps) => {
  //           .then(
  //             (posts, pages) => {
  //               // let combinedResults = posts[0].concat(pages[0], telreps[0]);
  //               let combinedResults = posts[0].concat(pages[0]);

  //               // let combinedResults = telreps[0];

  //               if (combinedResults.length) {
  //                 $('.live-search-results').html(`
  //               ${combinedResults
  //                 .map(
  //                   (post) =>
  //                     `<a style="text-align: center; padding: 8px 0px;display: block;border-bottom: 1px solid #e9e9e9;" href="${post.link}">${post.title.rendered}</a>`
  //                 )
  //                 .join('')}            
  //             `);
  //               } else {
  //                 searchResultsBox.html(
  //                   '<p style="text-align: center;">Sorry, niets gevonden.</p>'
  //                 );
  //               }
  //             },
  //             (error) => {
  //               searchResultsBox.html(
  //                 '<p style="text-align: center;">Er is een fout opgetreden.</p>'
  //               );
  //             }
  //           );
  //       }
  //     }
  //   });
  // });

  // // Prevent normal form submit behaviour
  // $('.search-form-header').submit(function (e) {
  //   e.preventDefault();
  // });
  // End of live search script

  // ===============================================================================================

  /**
   * #.# Navbar menu items
   *
   */

  $('.navbar-main .menu-main-menu-container > ul > .menu-item-has-children > a').after('<button class="menu-drop-down-icon-down"><i class="fas fa-chevron-down"></i></button>');

  $('.navbar-main .menu-main-menu-container > ul > li > ul > .menu-item-has-children > a').after('<button class="menu-drop-down-icon-right"><i class="fas fa-chevron-right"></i></button>');

  /*
   * #.# Search form toggle
   */

  $('.button-container .btn-search').click(function () {
    if ($('.search-bar-container').css('visibility') == 'hidden')
      $('.search-bar-container').css({
        visibility: 'visible',
        marginTop: '0px',
        opacity: '1',
      });
    else
      $('.search-bar-container').css({
        visibility: 'hidden',
        marginTop: '10px',
        opacity: '0',
      });
  });

  /* Make search hidden when clicking on the main content */

  $('.main-content').click(function () {
    if ($('.search-bar-container').css('visibility') == 'visible') {
      $('.search-bar-container').css({
        visibility: 'hidden',
        marginTop: '10px',
        opacity: '0',
      });
    }
  });

  /*
   * #.# Mobile menu toggle
   *
   */

  $('.menu-toggle-container .fa-bars').click(function () {
    $('.mobile-menu-side-menu').toggle('slide', { direction: 'right' }, 250);
  });

    /*
   * #.# Mobile filter woocommerce menu toggle
   *
   */
    // jQuery(".orderby option").each(function(i, e) {
    //   (jQuery("<input type='radio' name='r' />")
    //     .attr("value", jQuery(this).val())
    //     .attr("checked", i == 0)
    //     .click(function() {
    //         // jQuery(".orderby").val(jQuery(this).val()).prop('selected', true);

    //         // jQuery(".orderby").dropdown( 'select', jQuery(this).val());

    //         // $('select[name="orderby"]').change(function(){
    //         //   alert(jQuery(this).val());
    //         // });
    //         $('.orderby option:selected').removeAttr('selected');

    //         $(".orderby option[value='" + jQuery(this).val() + "']").attr("selected","selected");

    //         $('.woocommerce-ordering select').change(function() {
    //           this.form.submit();              
    //         });

    //         $('.orderby').trigger('change');          

    //         // $('.orderby').change(function(){
    //         //   // alert(jQuery(this).val());
    //         //   jQuery('.woocommerce-ordering').submit();
    //         // });

    //         // jQuery(".woocommerce-ordering").on("change", "select.orderby", function() {
    //         //   jQuery(this).closest("form").trigger("submit")
    //         // })

    //         // $('.orderby').trigger('change');

    //     }).add(jQuery("<label>"+ this.textContent +"</label>")))
    //     .appendTo("#r");
    // });
    


  $('.sidebar-drawer-button').click(function () {
    $('.shop-page-filter-drawer').toggle('slide', { direction: 'left' }, 300);
  });

  /* Bottom page filter button */
  $('.bottom-filter-button').click(function () {
    $('.shop-page-filter-drawer').toggle('slide', { direction: 'left' }, 300);
  });

  // Close woocommerce filter sidebar
  $('.shop-page-filter-drawer .woocommerce-drawer-menu-close-button .fa-times').click(
    function () {
      $('.shop-page-filter-drawer').toggle('slide', { direction: 'left' }, 300);
    }
  );

  /*
   * #.# Mobile menu navbar
   *
   */

  $(
    '.navbar-mobile .menu-main-menu-container > ul > .menu-item-has-children > a'
  ).after(
    '<button class="menu-drop-down-icon-down-mobile"><i id="lvl1" class="fas fa-chevron-down"></i></button>'
  );

  $(
    '.navbar-mobile .menu-main-menu-container > ul > li > ul > .menu-item-has-children > a'
  ).after(
    '<button class="menu-drop-down-icon-down-mobile"><i id="lvl2" class="fas fa-chevron-down"></i></button>'
  );

  /* 
  * #.# Close mobile menu 
  *
  */
  $('.mobile-menu-side-menu .mobile-menu-close-button .fa-times').click(
    function () {
      $('.mobile-menu-side-menu').toggle('slide', { direction: 'right' }, 250);
    }
  );

  // $('.main-content').click(function () {
  //   if ($('.mobile-menu-side-menu').css('display') == 'block') {
  //     $('.mobile-menu-side-menu').toggle('slide', { direction: 'right' }, 300);
  //   }
  // });



  // $('.main-content').click(function () {
  //   if ($('.shop-page-filter-drawer').css('display') == 'block') {
  //     $('.shop-page-filter-drawer').toggle('slide', { direction: 'left' }, 300);
  //   }
  // });

  /*
   * #.# Mobile menu navbar
   *
   * Menu items which have children
   *
   */

  $(
    '.navbar-mobile .menu-main-menu-container > ul > li > .menu-drop-down-icon-down-mobile'
  ).click(function () {
    $(this).find('#lvl1').toggleClass('fa-chevron-down fa-chevron-up');

    $(this).next('.sub-menu').slideToggle('fast');
  });

  $(
    '.navbar-mobile .menu-main-menu-container > ul > li > ul > li > .menu-drop-down-icon-down-mobile'
  ).click(function () {
    $(this).find('#lvl2').toggleClass('fa-chevron-down fa-chevron-up');

    $(this).next('.sub-menu').slideToggle('fast');
  });

  /* Detect if menu item with children has a link */
  $(
    '.navbar-mobile .menu-main-menu-container > ul > .menu-item-type-custom > a'
  ).click(function (e) {
    e.preventDefault();

    let hrefAttr = $(this).attr('href');

    if (!hrefAttr.includes('http') || !hrefAttr.includes('\\')) {
      $(this).next('.menu-drop-down-icon-down-mobile').click();
    }
  });

  $(
    '.navbar-mobile .menu-main-menu-container > ul > li > ul > .menu-item-type-custom > a'
  ).click(function (e) {
    e.preventDefault();

    let hrefAttr = $(this).attr('href');

    if (!hrefAttr.includes('http') || !hrefAttr.includes('\\')) {
      $(this).next('.menu-drop-down-icon-down-mobile').click();
    }
  });

  /*
  * #.# Add icon to add to cart button ajax shop page
  *  
  */
  $('.add_to_cart_button').html('<i class="fa-solid fa-plus"></i> <i class="fa-solid fa-cart-shopping"></i>');


});




