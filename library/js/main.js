jQuery(document).ready(function($) {

  function init() {
    splitWords();
    toggleNav();
    heroDishes();
    heroCarousel();
    loadHeroVideo();
    highlightedPostsCarousel();
    contactFormSubmit();
    contactTabs();
    faqs();
    zipCodeLocationsSearch();
    newsletterSubmit();
    stickyHeader();
    toggleLocationsView();
    menuFilter();
    blogFilter();
    matchHeight();
    fadeInOnScroll();
    initSelectric();
    reservationsSelect();
    parallaxIllustrations();
    rotateInOnScroll();
  }



  /**
   * Load different hero video src depending on viewport width
   */

  const loadHeroVideo = () => {
    const vid = $('.js-hero-vid');
    const desktopSrc = vid.data('desktop-src');
    const mobileSrc = vid.data('mobile-src');

    if ($(window).width() < 500) {
      vid.append("<source type='video/mp4' src='" + mobileSrc + "' />");
    } else {
      vid.append("<source type='video/mp4' src='" + desktopSrc + "' />");
    }
  }

  



  /**
   * Matchheight, desktop only
   */

  const matchHeight = () => {
    if ($(window).innerWidth() > 768) {
      $('.js-match-height').matchHeight();
    }
  }



  /**
   * Toggle Navigation
   */

  const toggleNav = () => {
    $('.js-nav-toggle').on('click', function(e) {
      e.preventDefault();

      const nav = $('.nav');
      const body = $('body');

      if ( body.hasClass('has-nav') ) {
        nav.removeClass('is-active');
        body.removeClass('has-nav');
      } else {
        nav.addClass('is-active');
        body.addClass('has-nav');
      }
    })
  }


  /**
   * Hero Carousel
   */

  const heroCarousel = () => {
    if ( $('.js-hero-carousel').length ) {
      const heroCarousel = $('.js-hero-carousel');
      const progressBar = document.querySelector('.hero .progress');

      // Init hero carousel
      
      heroCarousel.flickity({
        wrapAround: true,
        // fade: true,
        pageDots: false,
        prevNextButtons: false,
        adaptiveHeight: false,
        pauseAutoPlayOnHover: false,
      })
      
      // If more than one slide, update progress bar on change.
      const numSlides = heroCarousel.data('flickity').slides.length;

      if (numSlides > 1) {
        const duration = 5000;
        const interval = 7;
        let percentTime, tick, step;
  
        function startProgressbar() {
          resetProgressbar();
          percentTime = 0;
          tick = window.setInterval(increase, interval);
        };
        
        function increase() {
            step = (duration) / interval;
            percentTime += 100 / step;
            progressBar.style.width = percentTime + '%';
            
            if (percentTime >= 100) {
              heroCarousel.flickity('next');
              startProgressbar();
            }
        }
        
        function resetProgressbar() {
          progressBar.style.width = 0 + '%';
          clearTimeout(tick);
        }
        
        startProgressbar();
      }
    }
  }





  /**
   * Highlighted Posts Carousel
   * For Blog/Menu pages
   */

  const highlightedPostsCarousel = () => {
    if ( $('.js-hl-posts').length ) {
      const carousel = $('.js-hl-posts');

      // Init hero carousel
      
      carousel.flickity({
        wrapAround: true,
        fade: true,
        pageDots: false,
        prevNextButtons: true,
        adaptiveHeight: true,
        pauseAutoPlayOnHover: false,
        imagesLoaded: true,
        autoPlay: 4000,
        arrowShape: { 
          x0: 15,
          x1: 65, y1: 50,
          x2: 70, y2: 45,
          x3: 25
        }
      });

      // Progress bar & Background text
      const carouselData = carousel.data('flickity');
      const progressBar = carousel.parent().find('.c-wave-nav .progress')
      const numSlides = carouselData.slides.length;

      // Set initial progress width
      let progressStartingWidth = 100 / numSlides;
      progressBar.css('width', progressStartingWidth + '%');
      
      carousel.on('change.flickity', function(event, index) {
        // Update progress bar when slides change.
        const currSlideIndex1 = index + 1; 
        // const prevSlide = (index == 0) ? numSlides - 1 : index - 1;
        const newProgressWidth = (currSlideIndex1 / numSlides) * 100;
        progressBar.css('width', newProgressWidth + '%');
      })

    }
  }



  /**
   * Hero Dishes Slider
   */
  const heroDishes = () => {

    if ( $('.js-dishes-slider').length ) {
      const slider = $('.js-dishes-slider');

      // Initialise slider
      slider.flickity({
        wrapAround: true,
        fade: true,
        imagesLoaded: true,
        autoPlay: 3000,
        pageDots: false,
        adaptiveHeight: false,
        arrowShape: { 
          x0: 15,
          x1: 65, y1: 50,
          x2: 70, y2: 45,
          x3: 25
        }
      })

      // Progress bar & Background text
      const sliderData = slider.data('flickity');
      const progressBar = slider.parent().find('.c-wave-nav .progress')
      const numSlides = sliderData.slides.length;
      const bgTexts = $('.hero-dishes__bg-text h1');

      // Set initial progress width
      let progressStartingWidth = 100 / numSlides;
      progressBar.css('width', progressStartingWidth + '%');
      
      slider.on('change.flickity', function(event, index) {
        // Update progress bar when slides change.
        const currSlideIndex1 = index + 1; 
        const prevSlide = (index == 0) ? numSlides - 1 : index - 1;
        const newProgressWidth = (currSlideIndex1 / numSlides) * 100;
        progressBar.css('width', newProgressWidth + '%');

        // Update background text when slides change.
        if (bgTexts.length) {
          bgTexts.removeClass('is-active');
          bgTexts[index].classList.add('is-active');
        }
      })

      // Display slider once images are all loaded
      slider.imagesLoaded(function() {
        setTimeout(function() {
          slider.addClass('is-loaded');
        },100)
      })
    }
  }



  /**
   * Blog Filter
   * Filter by post_tag
   */

  const blogFilter = () => {
    
    // If not blog, do nothing
    if (! $('.page-template-whats-new').length ) {
      return;
    }

    const grid = $('.js-post-grid');
    let tagIds = [];
    let sortby;

    // Filter blog on clicking on tags
    $('.js-tag').on('click', function(e) {
      e.preventDefault();

      // Set tags active states
      if ( $(this).hasClass('is-active') ) {
        $(this).removeClass('is-active');
      } else  {
        $(this).addClass('is-active');
      }

      // Get active tags
      getTagIds();

      // Get sortby condition
      sortby = $('.js-sortby').val();

      // Run ajax filter
      filterBlog();
    })

    // Filter blog on changing sortby select.
    $('.js-sortby').on('change', function() {
      // Get active tags
      getTagIds();

      // Get sortby condition
      sortby = $('.js-sortby').val();

      // Run ajax filter
      filterBlog();
    })

    
    // Loop through active tags and store tag ids in new array.
    function getTagIds() {
      const tags = $('.js-tag.is-active');
      tagIds = [];

      tags.each(function(i, item) {
        tagIds.push($(item).data('tag'));
      });

    }

    // Filter the blog via AJAX
    function filterBlog() {
      
      const data = {
        'tag_ids': tagIds,
        'sortby': sortby,
        'action': 'filter_blog',
      }

      $.ajax({
        url: script_vars.ajaxUrl,
        type: 'POST',
        data: data,
        success: function(response) {
          // Fade out old blog posts
          grid.fadeTo(400, 0);
          setTimeout(function() {
            
            // Display filtered blog posts
            grid.empty();
            grid.append(response);
            if ($(window).innerWidth() > 768) {
              $('.js-match-height').matchHeight();
            }
            grid.fadeTo(400, 1);
            
          }, 400)
        }
      });
    }
  }



  /**
   * lettering.js 
   * Used to resize text to fit 100vw of browser dynamically
   */

  const splitWords = () => {
     $('.js-lettering').lettering();
     
     // Adjust font size for longer country names.
     if ($(window).innerWidth() >= 992) {
       $('.js-lettering').each((index, item) => {
          if ( $(item).children().length > 9 ) {
            $(item).css({
              'fontSize': '320px',
              'top': '5%',
            });
          }
          if ( $(item).children().length > 12 ) {
            $(item).css({
              'fontSize': '180px',
              'left': '-1vw'
            });
          }
       })
     }
  }


  /**
   * Contact Form Submit
   */

  const contactFormSubmit = () => {
    if ($('.wpcf7').length) {

      const buttons = $('.c-form .c-btn');

      buttons.click(function(e) {
        e.preventDefault();
        $(this).closest('.c-form').find('.wpcf7-submit').trigger('click');
      })

    }
  }



  /**
   * Contact Page Tabbed Forms
   */

  const contactTabs = () => {
    if ($('.contact-tabs').length) {

      // Toggle forms when tabs clicked
      $('.js-contact-tab').click(function(e) {
        e.preventDefault();

        if ( $(this).hasClass('is-active') ) {
          return;
        } else {
          const tabIndex = $(this).data('tab-index');
          console.log(tabIndex);
          
          $('.js-contact-tab').removeClass('is-active');
          $(this).addClass('is-active');

          $('.js-form-container').fadeOut(400);
          // $('.js-form-container').removeClass('is-active');
          setTimeout(function() {
            // $(`.js-form-container[data-tab-index="${tabIndex}"]`).addClass('is-active');
            $(`.js-form-container[data-tab-index="${tabIndex}"]`).fadeIn(400);
          }, 400);

        }

      })
    }
  }



  /**
   * Toggle Locations View
   */

  const toggleLocationsView = () => {
    $('.js-list-view').on('click', function() {
      
      $(this).addClass('is-active');
      $('.js-map-view').removeClass('is-active');
      $('.js-map-view-container').fadeOut(400);
      
      setTimeout(function() {
        $('.js-list-view-container').fadeIn(400);
      }, 400)
    });

    $('.js-map-view').on('click', function() {

      $(this).addClass('is-active');
      $('.js-list-view').removeClass('is-active');      
      $('.js-list-view-container').fadeOut(400);
      
      setTimeout(function() {
        $('.js-map-view-container').fadeIn(400);
      }, 400)
    })
  }



  /**
   * Faqs Accordions
   */

  const faqs = () => {
    if ($('.faqs').length) {
      const questions = $('.js-faqs-toggle');
      questions.on('click', function(e, element) {

        // Toggle FAQ question
        if ($(this).parent().hasClass('is-active')) {
          $(this).parent().removeClass('is-active');
        } else {
          $('.faqs__question-container').removeClass('is-active');
          $(this).parent().addClass('is-active');
        }


        // Place question at top of window
        const selectedQuestionOffset = $(this).parent().offset().top - 10;
        // $(window).scrollTop(selectedQuestionOffset);
      })
    }
  }



  /**
   * Newsletter submit button
   */

  const newsletterSubmit = () => {
    $('.js-mailchimp-submit').on('click', function(e) {
      e.preventDefault();
      $('.js-mailchimp-submit').closest('#mc_embed_signup').find('#mc-embedded-subscribe').trigger('click');
    })
  }



  /**
   * Sticky Header
   */

  const stickyHeader = () => {
    $(window).on('load scroll', function() {
      if ( $(window).scrollTop() > 50 ) {
        $('body').addClass('is-scrolled');
      } else {
        $('body').removeClass('is-scrolled');
      }
    })
  }




  /**
   * Find nearest location by zip code
   */

  const zipCodeLocationsSearch = () => {

    if ($('.js-search-location')) {
      $('.js-search-location').on('submit', function(e) {
        e.preventDefault();

        // If any, clear previous errors
        $('.find-loc__error').remove();

        const zipcode = $('.js-zipcode').val();
        const locContainer = $('.js-locations-container');
        let latLong;

        $.ajax({
          url: script_vars.geocode_url + 'address=' + zipcode + '&key=' + script_vars.maps_api_key, 
          dataType: 'json',
          success: function(response) {

            // If no zipcode corresponds...
            if (response.status == 'ZERO_RESULTS') {
              $('.find-loc__search').after('<p class="find-loc__error">Zipcode or address not recognised.</p>');
            } 
            
            // If zipcode found and geocode data returned successfully
            if (response.status == 'OK') {
              console.log(response.results[0].geometry.location);
              latLong = response.results[0].geometry.location;

              if (latLong) {

                const data = {
                  action: 'sort_locations_by_distance',
                  latLong: latLong,
                }

                // Fade out & remove locations
                locContainer.addClass('is-faded');

                $.ajax({
                  url: script_vars.ajaxUrl,
                  type: 'POST',
                  data: data,
                  success: function(response) {

                    setTimeout(() => {
                      locContainer.empty();

                      // Add new re-ordered locations & fade-in
                      console.log(response);
                      locContainer.append(response);
                      locContainer.removeClass('is-faded');
                    }, 300);

                  }
                })
              }
            }
          }
        })
      })
    }
  }



  /**
   * Init selectric
   * @link https://selectric.js.org/
   */

  const initSelectric = () => {
    $('.js-selectric').selectric({
      nativeOnMobile: false,
    });
  }


  /**
   * Scrolling Fade In Animations
   */

  const fadeInOnScroll = () => {

    // Check if internet explorer and turn off scrolling animations if so.
    var ua = window.navigator.userAgent; // Check the userAgent property of the window.navigator object
    var msie = ua.indexOf('MSIE '); // IE 10 or older
    var trident = ua.indexOf('Trident/'); //IE 11

    if (msie > 0 || trident > 0) { // If IE 11 or worse
      $('.js-hidden').removeClass('js-hidden');
      return;
    }

    const sections = document.querySelectorAll('.js-hidden');


    // Fade in sections
    const fadeInVisible = () => {
      sections.forEach((s,i) => {
          if (s.getBoundingClientRect().top <= window.innerHeight - 30) {
              // console.log('scrollPos: '+scrollPos);
              // console.log(s.getBoundingClientRect().top);
              s.classList.add('js-visible');
          }
      })
    }
    $(document).on('scroll resize', fadeInVisible);
    $(window).load(fadeInVisible);

    

  }


  /**
   * Rotating roundels on scroll
   */

  const rotateRoundel = () => {
    $(window).scroll(function() {

      //Make the circular motif rotate as you scroll
      $('.js-rotate-scroll').css('transform','rotate('+ ($(window).scrollTop() / 3)+'deg)');

    });
  }




  /**
   * Menu Filter
   * Filter by dietary info and menu type
   */

  const menuFilter = () => {

    function filterMenu() {
      const menuItemsContainer = $('.js-menu-items');
  
      // Get menu types selected.
      let activeMenuTypes = [];
      if ( $(window).innerWidth() >= 992 ) { // If desktop, get menu_types from selected tabs
        $('.js-menu-type.is-active').each(function(i, item) {
          const menuTypeID = $(item).data('menu-type');
          activeMenuTypes.push(menuTypeID);
        });
      } else {
        // If mobile, get menu type chosen in select field.
        activeMenuTypes.push($('.js-menu-type-select').val());
      }
  
      // Get dietary info
      let activeDietInfo = [];
      $('.js-dietary-info').each(function(i, item) {
        if ( $(item).is(':checked') ) {
          const id = $(item).data('dietary-info');
          activeDietInfo.push(id);
        }
      });
  
      const data = {
        'action': 'menu_filter',
        'menu_types': activeMenuTypes,
        'diet_info': activeDietInfo,
      }

      // Disable filter control
      $('.js-filter-control').addClass('is-disabled');
  
      $.ajax({
        url: script_vars.ajaxUrl,
        type: 'POST',
        data: data,
        success: function(response) {
          menuItemsContainer.fadeTo(500, 0);
          setTimeout(function() {
            menuItemsContainer.empty();
            menuItemsContainer.append(response);
            menuItemsContainer.fadeTo(500, 1);
            $('.js-filter-control').removeClass('is-disabled');
          }, 500);
        }
      });
    }

    $('.js-menu-type').click(function(e) {
      e.preventDefault();
      
      // Set active state for filter button
      if ( $(this).hasClass('is-active') ) {
        $(this).removeClass('is-active');
      } else {
        $(this).addClass('is-active');
      }

      filterMenu();
    });
    
    $('.js-menu-type-select, .js-dietary-info').on('change', function() {
      filterMenu()
    });
  }



  /**
   * Reservations Select on reservations template
   */

  const reservationsSelect = () => {
    if ($('.reservation').length) {
      $('.js-reservation-select').on('change', function() {
        const href = $(this).val();
        const btn = $(this).closest('.row').find('#reservations-submit');
        console.log(href);
        btn.attr('href', href);
        btn.addClass('is-active');
      })
    }
  }



  /**
   * Apply parallax effect to background illustrations (leaves, flowers, etc)
   * Depends on GSAP & GSAPs scrollTrigger library 
   * @link https://greensock.com/docs/v3/Plugins/ScrollTrigger
   */

  const parallaxIllustrations = () => {
    
    // Do nothing if mobile
    if ( $(window).innerWidth() < 768 ) {
      return;
    }

    if ($('.js-prlx').length) {
      gsap.registerPlugin(ScrollTrigger);


      // Vertical parallax effect
      gsap.utils.toArray('.js-prlx').forEach(prlxItem => {
        gsap.fromTo(prlxItem, 
          {
            y: 200,
          },
          {
            scrollTrigger: {
              trigger: prlxItem,
              start: "top bottom",
              end: "bottom 100px",
              scrub: true, // Give positive integer as value to get more easing/smoothness (e.g. 2,3,4)
              markers: false, // Set to true to add markers to UI to debug.
            },
            y: -50,
            ease: "none",
            duration: 2,
          }
        );
      });
    }



    // The same vertical parallax effect as above but triggers slightly earlier
    gsap.utils.toArray('.js-prlx--early').forEach(prlxItem => {
      gsap.fromTo(prlxItem, 
        {
          y: 200,
        },
        {
          scrollTrigger: {
            trigger: prlxItem,
            start: "top bottom",
            end: "bottom 350",
            scrub: true, // Give positive integer as value to get more easing/smoothness (e.g. 2,3,4)
            markers: false, // Set to true to add markers to UI to debug.
          },
          y: -50,
          ease: "none",
          duration: 2,
        }
      );
    });


    // Parallax effect with slight rotation.
    if ($('.js-prlx--rotate').length) {
      gsap.registerPlugin(ScrollTrigger);

      gsap.utils.toArray('.js-prlx--rotate').forEach(prlxItem => {
        gsap.fromTo(prlxItem, 
          {
            y: 200,
            rotation: 22,
          },
          {
            scrollTrigger: {
              trigger: prlxItem,
              start: "top bottom",
              end: "bottom 100px",
              scrub: true, // Give positive integer as value to get more easing/smoothness (e.g. 2,3,4)
              markers: false, // Set to true to add markers to UI to debug.
            },
            y: -50,
            rotation: 0,
            ease: "none",
            duration: 2,
          }
        );
      });
    }
  }



  /**
   * Make content/image blocks rotate in on scroll
   */

  const rotateInOnScroll = () => {
    if ( $('.js-rotate-trigger').length && $(window).innerWidth() > 991 ) {

      gsap.registerPlugin(ScrollTrigger);

      gsap.utils.toArray('.js-rotate-anticlock').forEach(prlxItem => {

        var prlxItemTrigger = prlxItem.closest('.js-rotate-trigger');
        
        gsap.fromTo(prlxItem, 
          {
            rotation: 2,
          },
          {
            scrollTrigger: {
              trigger: prlxItemTrigger,
              start: "top bottom",
              end: "top 100px",
              scrub: 1, // Give positive integer as value to get more easing/smoothness (e.g. 2,3,4)
              markers: false, // Set to true to add markers to UI to debug.
            },
            rotation: -3,
            ease: "linear",
            duration: 2,
          }
        );
      });



      gsap.utils.toArray('.js-rotate-clock').forEach(prlxItem => {
        
        var prlxItemTrigger = prlxItem.closest('.js-rotate-trigger');
        
        gsap.fromTo(prlxItem, 
          {
            rotation: -2,
          },
          {
            scrollTrigger: {
              trigger: prlxItemTrigger,
              start: "top bottom",
              end: "top 100px",
              scrub: 1, // Give positive integer as value to get more easing/smoothness (e.g. 2,3,4)
              markers: false, // Set to true to add markers to UI to debug.
            },
            rotation: 3,
            ease: "linear",
            duration: 2,
          }
        );
      });


    }
  }





   init();

})