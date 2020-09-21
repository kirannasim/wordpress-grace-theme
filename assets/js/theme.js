(function($) {
  'use strict';

  $.fn.appear = function(fn, options) {

    var settings = $.extend({

      //arbitrary data to pass to fn
      data: undefined,

      //call fn only on the first appear?
      one: true,

      // X & Y accuracy
      accX: 0,
      accY: 0

    }, options);

    return this.each(function() {

      var t = $(this);

      //whether the element is currently visible
      t.appeared = false;

      if (!fn) {

        //trigger the custom event
        t.trigger('appear', settings.data);
        return;
      }

      var w = $(window);

      //fires the appear event when appropriate
      var check = function() {

        //is the element hidden?
        if (!t.is(':visible')) {

          //it became hidden
          t.appeared = false;
          return;
        }

        //is the element inside the visible window?
        var a = w.scrollLeft();
        var b = w.scrollTop();
        var o = t.offset();
        var x = o.left;
        var y = o.top;

        var ax = settings.accX;
        var ay = settings.accY;
        var th = t.height();
        var wh = w.height();
        var tw = t.width();
        var ww = w.width();

        if (y + th + ay >= b &&
          y <= b + wh + ay &&
          x + tw + ax >= a &&
          x <= a + ww + ax) {

          //trigger the custom event
          if (!t.appeared) t.trigger('appear', settings.data);

        } else {

          //it scrolled out of view
          t.appeared = false;
        }
      };

      //create a modified fn with some additional logic
      var modifiedFn = function() {

        //mark the element as visible
        t.appeared = true;

        //is this supposed to happen only once?
        if (settings.one) {

          //remove the check
          w.unbind('scroll', check);
          var i = $.inArray(check, $.fn.appear.checks);
          if (i >= 0) $.fn.appear.checks.splice(i, 1);
        }

        //trigger the original fn
        fn.apply(this, arguments);
      };

      //bind the modified fn to the element
      if (settings.one) t.one('appear', settings.data, modifiedFn);
      else t.bind('appear', settings.data, modifiedFn);

      //check whenever the window scrolls
      w.scroll(check);

      //check whenever the dom changes
      $.fn.appear.checks.push(check);

      //check now
      (check)();
    });
  };

  //keep a queue of appearance checks
  $.extend($.fn.appear, {

    checks: [],
    timeout: null,

    //process the queue
    checkAll: function() {
      var length = $.fn.appear.checks.length;
      if (length > 0) while (length--) ($.fn.appear.checks[length])();
    },

    //check the queue asynchronously
    run: function() {
      if ($.fn.appear.timeout) clearTimeout($.fn.appear.timeout);
      $.fn.appear.timeout = setTimeout($.fn.appear.checkAll, 20);
    }
  });

  //run checks when these methods are called
  $.each(['append', 'prepend', 'after', 'before', 'attr',
    'removeAttr', 'addClass', 'removeClass', 'toggleClass',
    'remove', 'css', 'show', 'hide'], function(i, n) {
    var old = $.fn[n];
    if (old) {
      $.fn[n] = function() {
        var r = old.apply(this, arguments);
        $.fn.appear.run();
        return r;
      }
    }
  });

})(jQuery);

// Theme
window.theme = {};

// Theme Common Functions
window.theme.fn = {

  getOptions: function(opts) {

    if (typeof(opts) == 'object') {

      return opts;

    } else if (typeof(opts) == 'string') {

      try {
        return JSON.parse(opts.replace(/'/g,'"').replace(';',''));
      } catch(e) {
        return {};
      }

    } else {

      return {};

    }

  }

};

// Header Sticky
(function($) {
  'use strict';

  // Scroll to Top Button.
  if (typeof theme.PluginScrollToTop !== 'undefined') {
    theme.PluginScrollToTop.initialize();
  }

  $(window).on('scroll', function() {
    if ($('.sticky').length == 0)
      return;

    var stickyTop = $('.sticky')[0].offsetTop;

    if (window.pageYOffset > stickyTop) {
      $('.sticky').addClass('header-sticky');
    } else {
      $('.sticky').removeClass('header-sticky');
    }
  });

}).apply(this, [jQuery]);

// Isotope Plugin
(function(theme, $) {
  'use strict';

  theme = theme || {};

  var instanceName = '__isotope';

  var PluginIsotope = function($el, opts) {
    return this.initialize($el, opts);
  };

  PluginIsotope.defaults = {
    itemSelector: '.grid-item'
  };

  PluginIsotope.prototype = {
    initialize: function($el, opts) {
      if ($el.data(instanceName)) {
        return this;
      }

      this.$el = $el;

      this
        .setData()
        .setOptions(opts)
        .build();

      return this;
    },

    setData: function() {
      this.$el.data(instanceName, this);

      return this;
    },

    setOptions: function(opts) {
      this.options = $.extend(true, {}, PluginIsotope.defaults, opts, {
        wrapper: this.$el
      });

      return this;
    },

    build: function() {
      if (!($.isFunction($.fn.isotope))) {
        return this;
      }

      var self = this,
        $el = this.options.wrapper,
        $isotope = $el.find('[data-grid]').isotope(self.options);

      // $isotope.find('img').lazy();

      $el.find('[data-filter]').on('click', function(evt) {
        evt.preventDefault();
        var $filterWrapper = $(this);
        var $filterValue = $(this).attr('data-filter');

        $el.find('[data-filter].active').removeClass('active');
        $filterWrapper.addClass('active');

        $isotope.isotope({ filter: $filterValue });
      });

      return this;
    }
  };

  // expose to scope
  $.extend(theme, {
    PluginIsotope: PluginIsotope
  });

  // jquery plugin
  $.fn.themePluginIsotope = function(opts) {
    return this.map(function() {
      var $this = $(this);

      if ($this.data(instanceName)) {
        return $this.data(instanceName);
      } else {
        return new PluginIsotope($this, opts);
      }
    });
  }

}).apply(this, [window.theme, jQuery]);


// Parallax
(function(theme, $) {
  'use strict';

  theme = theme || {};

  var instanceName = '__parallax';

  var PluginParallax = function($el, opts) {
    return this.initialize($el, opts);
  };

  PluginParallax.defaults = {
    speed: 5,
    horizontalPosition: 'center',
    offset: 0
  };

  PluginParallax.prototype = {
    initialize: function($el, opts) {
      if ($el.data(instanceName)) {
        return this;
      }

      this.$el = $el;

      this
        .setData()
        .setOptions(opts)
        .build();

      return this;
    },

    setData: function() {
      this.$el.data(instanceName, this);

      return this;
    },

    setOptions: function(opts) {
      this.options = $.extend(true, {}, PluginParallax.defaults, opts, {
        wrapper: this.$el
      });

      return this;
    },

    build: function() {
      var self = this,
        $window = $(window),
        offset,
        yPos,
        bgpos,
        background;

      
      // Parallax Effect on Scroll & Resize
      var parallaxEffectOnScrolResize = function() {
        // Create Parallax Element
        background = $('<div class="parallax-background lazy"><div class="parallax-overlay"></div></div>');

        // Set Style for Parallax Element
        background.css({
          'background-image' : 'url(' + self.options.wrapper.data('image-src') + ')',
          'background-size' : 'cover',
          'position' : 'absolute',
          'top' : 0,
          'left' : 0,
          'width' : '100%',
          'height' : '180%'
        });

        // Add Parallax Element on DOM
        self.options.wrapper.prepend(background);

        // Set Overlfow Hidden and Position Relative to Parallax Wrapper
        self.options.wrapper.css({
          'position' : 'relative',
          'overflow' : 'hidden'
        });

        $window.on('scroll resize', function() {
          var offset  = self.options.wrapper.offset();
          // var yPos    = -($window.scrollTop() - offset.top) / ((self.options.speed * 5 ) + (self.options.offset));
          // var plxPos  = (yPos < 0) ? Math.abs(yPos) : -Math.abs(yPos);

          var yPos    = -($window.scrollTop() - (offset.top - 100)) / (self.options.speed + self.options.offset);
          var plxPos  = (yPos < 0) ? Math.abs(yPos) : -Math.abs(yPos);

          background.css({
            'transform' : 'translate3d(0, ' + plxPos + 'px, 0)',
            'background-position-x' : self.options.horizontalPosition
          });
        });

        $window.trigger('scroll');
      }

      if ($(window).width() > 990) {
        parallaxEffectOnScrolResize();
      } else {
        self.options.wrapper.css({
          'background-image' : 'url(' + self.options.wrapper.data('image-src') + ')'
        });

        var overlay = $('<div class="parallax-overlay"></div>');
        self.options.wrapper.prepend(overlay);
      }

      return this;
    }
  };

  // expose to scope
  $.extend(theme, {
    PluginParallax: PluginParallax
  });

  // jquery plugin
  $.fn.themePluginParallax = function(opts) {
    return this.map(function() {
      var $this = $(this);

      if ($this.data(instanceName)) {
        return $this.data(instanceName);
      } else {
        return new PluginParallax($this, opts);
      }

    });
  }

}).apply(this, [window.theme, jQuery]);


// Owl Carousel
(function(theme, $) {
  'use strict';

  theme = theme || {};

  var instanceName = '__owl';

  var PluginOwlCarousel = function($el, opts) {
    return this.initialize($el, opts);
  };

  PluginOwlCarousel.defaults = {
    loop: true,
    lazyLoad: true,
    items: 1,
    margin: 10,
    responsiveClass: true,
    nav: false,
    dots: false,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    autoWidth: false,
    navText: ["<i class='nav arrow-left'></i>","<i class='nav arrow-right'></i>"],
    responsive: {
      0: {
          items: 1
      },      
      768: {
        items: 2
      }
    }
  };

  PluginOwlCarousel.prototype = {
    initialize: function($el, opts) {
      if ($el.data(instanceName)) {
        return this;
      }

      this.$el = $el;

      this
        .setData()
        .setOptions(opts)
        .build();

      return this;
    },

    setData: function() {
      this.$el.data(instanceName, this);

      return this;
    },

    setOptions: function(opts) {
      this.options = $.extend(true, {}, PluginOwlCarousel.defaults, opts, {
        wrapper: this.$el
      });

      return this;
    },

    build: function() {
      if (!($.isFunction($.fn.owlCarousel))) {
        return this;
      }

      var self = this,
        $el = this.options.wrapper;

      $el.owlCarousel(self.options);

      return this;
    }
  };

  // expose to scope
  $.extend(theme, {
    PluginOwlCarousel: PluginOwlCarousel
  });

  // jquery plugin
  $.fn.themePluginOwlCarousel = function(opts) {
    return this.map(function() {
      var $this = $(this);

      if ($this.data(instanceName)) {
        return $this.data(instanceName);
      } else {
        return new PluginOwlCarousel($this, opts);
      }

    });
  }

}).apply(this, [window.theme, jQuery]);


// Magnific Popup Plugin
(function(theme, $) {
  'use strict';

  theme = theme || {};

  var instanceName = '__magnificPopup';

  var PluginMagnificPopup = function($el, opts) {
    return this.initialize($el, opts);
  };

  PluginMagnificPopup.defaults = {
    type: 'inline',
    preloader: false
  };

  PluginMagnificPopup.prototype = {
    initialize: function($el, opts) {
      if ($el.data(instanceName)) {
        return this;
      }

      this.$el = $el;

      this
        .setData()
        .setOptions(opts)
        .build();

      return this;
    },

    setData: function() {
      this.$el.data(instanceName, this);

      return this;
    },

    setOptions: function(opts) {
      this.options = $.extend(true, {}, PluginMagnificPopup.defaults, opts, {
        wrapper: this.$el
      });

      return this;
    },

    build: function() {
      if (!($.isFunction($.fn.magnificPopup))) {
        return this;
      }

      var self = this,
        $el = this.options.wrapper;

      $el.magnificPopup(self.options);

      return this;
    }
  };

  // expose to scope
  $.extend(theme, {
    PluginMagnificPopup: PluginMagnificPopup
  });

  // jquery plugin
  $.fn.themePluginMagnificPopup = function(opts) {
    return this.map(function() {
      var $this = $(this);

      if ($this.data(instanceName)) {
        return $this.data(instanceName);
      } else {
        return new PluginMagnificPopup($this, opts);
      }
    });
  }

}).apply(this, [window.theme, jQuery]);

// Video Popup Plugin
(function(theme, $) {
  'use strict';

  theme = theme || {};

  var instanceName = '__videoPopup';

  var PluginVideoPopup = function($el, opts) {
    return this.initialize($el, opts);
  };

  PluginVideoPopup.defaults = {
    type: 'iframe',
    iframe: {
      markup: '<div class="mfp-iframe-scaler">'+
        '<div class="mfp-close"></div>'+
        '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
        '</div>',
      patterns: {
        youtube: {
          index: 'youtube.com/',
          id: 'v=',
          src: '//www.youtube.com/embed/%id%?autoplay=1'
        },
        vimeo: {
          index: 'vimeo.com/',
          id: '/',
          src: '//player.vimeo.com/video/%id%?autoplay=1'
        },
        gmaps: {
          index: '//maps.google.',
          src: '%id%&output=embed'
        }
      },
      srcAction: 'iframe_src',
    }
  };

  PluginVideoPopup.prototype = {
    initialize: function($el, opts) {
      if ($el.data(instanceName)) {
        return this;
      }

      this.$el = $el;

      this
        .setData()
        .setOptions(opts)
        .build();

      return this;
    },

    setData: function() {
      this.$el.data(instanceName, this);

      return this;
    },

    setOptions: function(opts) {
      this.options = $.extend(true, {}, PluginVideoPopup.defaults, opts, {
        wrapper: this.$el
      });

      return this;
    },

    build: function() {
      if (!($.isFunction($.fn.magnificPopup))) {
        return this;
      }

      var self = this,
        $el = this.options.wrapper;

      $el.magnificPopup(self.options);

      return this;
    }
  };

  // expose to scope
  $.extend(theme, {
    PluginVideoPopup: PluginVideoPopup
  });

  // jquery plugin
  $.fn.themePluginVideoPopup = function(opts) {
    return this.map(function() {
      var $this = $(this);

      if ($this.data(instanceName)) {
        return $this.data(instanceName);
      } else {
        return new PluginVideoPopup($this, opts);
      }
    });
  }

}).apply(this, [window.theme, jQuery]);

// Tabs Plugin
(function(theme, $) {
  'use strict';

  theme = theme || {};

  var instanceName = '__tabs';

  var PluginTabs = function($el, opts) {
    return this.initialize($el, opts);
  };

  PluginTabs.defaults = {
    'itemSelector': 'a'
  };

  PluginTabs.prototype = {
    initialize: function($el, opts) {
      if ($el.data(instanceName)) {
        return this;
      }

      this.$el = $el;

      this
        .setData()
        .setOptions(opts)
        .build();

      return this;
    },

    setData: function() {
      this.$el.data(instanceName, this);

      return this;
    },

    setOptions: function(opts) {
      this.options = $.extend(true, {}, PluginTabs.defaults, opts, {
        wrapper: this.$el
      });

      return this;
    },

    build: function() {
      var self = this,
        $el = this.options.wrapper,
        $itemSelector = this.options.itemSelector;

      $el.find('[data-tab-list]').find($itemSelector).on('click', function(event) {
        event.preventDefault();

        var $this = $(this),
          $href = ($itemSelector == 'a' ? $this.attr('href') : $this.find('a').attr('href'));

        $el.find('[data-tab-list] .active').removeClass('active');
        $el.find('.tab-content.active').removeClass('active');

        $this.addClass('active');
        $el.find('.tab-content' + $href).addClass('active');
      });

      return this;
    }
  };

  // expose to scope
  $.extend(theme, {
    PluginTabs: PluginTabs
  });

  // jquery plugin
  $.fn.themePluginTabs = function(opts) {
    return this.map(function() {
      var $this = $(this);

      if ($this.data(instanceName)) {
        return $this.data(instanceName);
      } else {
        return new PluginTabs($this, opts);
      }
    });
  }

}).apply(this, [window.theme, jQuery]);

// Google map Plugin
(function(theme, $) {
  'use strict';

  theme = theme || {};

  var instanceName = '__google_map';

  var PluginGoogleMap = function($el, opts) {
    return this.initialize($el, opts);
  };

  PluginGoogleMap.defaults = {
    wrapperId: 'map',
    mapOptions: {
      zoom: 16,
      center: {
        lat: 40.6898297,
        lng: -73.94250620000003,
      },
      panControl: false,
      zoomControl: true,
      mapTypeControl: false,
      streetViewControl: false,
      fullscreenControl: false,
      mapTypeId: 'roadmap',
      scrollwheel: false
    }
  };

  PluginGoogleMap.prototype = {
    initialize: function($el, opts) {
      if ($el.data(instanceName)) {
        return this;
      }

      this.$el = $el;

      this
        .setData()
        .setOptions(opts)
        .build();

      return this;
    },

    setData: function() {
      this.$el.data(instanceName, this);

      return this;
    },

    setOptions: function(opts) {
      this.options = $.extend(true, {}, PluginGoogleMap.defaults, opts, {
        wrapper: this.$el
      });

      return this;
    },

    build: function() {
      var self = this,
        $options = this.options,
        $el = this.options.wrapper;

      var content = $el.html();

      $options.mapOptions = $.extend(true, {}, $options.mapOptions, {
        center: {
          lat: $el.data('lat'),
          lng: $el.data('lng')
        }
      });

      var map = new google.maps.Map(document.getElementById($el.attr('id')), $options.mapOptions);

      var marker = new google.maps.Marker({
        position: $options.mapOptions.center,
        map: map
      });

      marker.setMap(map);

      if (content) {
        // Create info window.
        var infowindow = new google.maps.InfoWindow({
            content: content
        });
        
        infowindow.open(map, marker);

        // Show info window when marker is clicked.
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
        });  
      }      

      return this;
    }
  };

  // expose to scope
  $.extend(theme, {
    PluginGoogleMap: PluginGoogleMap
  });

  // jquery plugin
  $.fn.themePluginGoogleMap = function(opts) {
    return this.map(function() {
      var $this = $(this);

      if ($this.data(instanceName)) {
        return $this.data(instanceName);
      } else {
        return new PluginGoogleMap($this, opts);
      }
    });
  }

}).apply(this, [window.theme, jQuery]);


// Neighborhood map Plugin
(function(theme, $) {
  'use strict';

  theme = theme || {};

  var instanceName = '__neightborhood_map';

  var PluginNeighborhoodMap = function($el, opts) {
    return this.initialize($el, opts);
  };

  PluginNeighborhoodMap.defaults = {
    wrapperId: 'map',
    mapOptions: {
      zoom: 13,
      panControl: false,
      zoomControl: true,
      mapTypeControl: false,
      streetViewControl: false,
      fullscreenControl: false,
      mapTypeId: 'roadmap',
      scrollwheel: false
    }
  };

  PluginNeighborhoodMap.prototype = {
    initialize: function($el, opts) {
      if ($el.data(instanceName)) {
        return this;
      }

      this.$el = $el;

      this
        .setData()
        .setOptions(opts)
        .build();

      return this;
    },

    setData: function() {
      this.$el.data(instanceName, this);

      return this;
    },

    setOptions: function(opts) {
      this.options = $.extend(true, {}, PluginNeighborhoodMap.defaults, opts, {
        wrapper: this.$el
      });

      return this;
    },

    build: function() {
      var self = this,
        $options = this.options,
        $el = this.options.wrapper;

      const listOfLocations = $el.find('.location');
      const locations = [];
      const markers = [];
      var activeInfoWindow;

      $options.mapOptions = $.extend(true, {}, $options.mapOptions, {
        center: {
          lat: $el.data('center-lat'),
          lng: $el.data('center-lng')
        }
      });

      const map = new google.maps.Map(document.getElementById($options.wrapperId), $options.mapOptions);

      listOfLocations.each(function() {
        const locationDOM = $(this);
        const lat = locationDOM.data('lat');
        const lng = locationDOM.data('lng');
        const name = locationDOM.find('.location-name').html();
        const infoWindowContent = locationDOM.find('.location-infowindow-content').html();
        const category = locationDOM.closest('li').find('.neighborhood-category').data('category');

        const latLngSet = new google.maps.LatLng(lat, lng);
        const marker = new google.maps.Marker({
          map: map,
          position: latLngSet
        });

        const infoWindow = new google.maps.InfoWindow();

        google.maps.event.addListener(infoWindow, 'domready', function () {
          const infoWindowWrapper = $('.info-window').closest('.gm-style-iw-a');
          infoWindowWrapper.addClass('active');
        });

        google.maps.event.addListener(marker, 'click', function () {
          if (activeInfoWindow) { activeInfoWindow.close(); }

          infoWindow.setContent(infoWindowContent);
          infoWindow.open(map, marker);

          activeInfoWindow = infoWindow;
        });

        const location = {
          locationDOM: locationDOM,
          lat: lat,
          lng: lng,
          name: name,
          infoWindowContent: infoWindowContent,
          category: category,
          marker: marker,
          infoWindow: infoWindow
        }

        locationDOM.find('.location-infowindow-content').remove();

        locations.push(location);
      });

      bindMarkerToList();
      // bindListToMarker();
      showSelectedCategoryMarkers();

      function bindMarkerToList() {
        $.each(locations, function(inx, location) {
          google.maps.event.addListener(location.marker, 'click', function () {
            makeAllListLocationsInactive();
            location.locationDOM.addClass('active');
          });

          google.maps.event.addListener(location.infoWindow, 'closeclick', function () {
            location.locationDOM.removeClass('active');
          });
        });
      }
      
      /*
      function bindListToMarker() {
        $.each(locations, function(inx, location) {
          location.locationDOM.on('click', function() {
            if (activeInfoWindow) { activeInfoWindow.close(); }

            makeAllListLocationsInactive();
            location.locationDOM.addClass('active');

            location.infoWindow.setContent(location.infoWindowContent);
            location.infoWindow.open(map, location.marker);

            activeInfoWindow = location.infoWindow;
          });
        });
      }*/

      function showSelectedCategoryMarkers() {
        var categories = $('.neighborhood-category');
        var isSelectedCategory = false;

        categories.each(function() {
          var category = $(this);

          category.on('click', function() {
            // var id = category.attr('aria-controls');
            var categoryLocations = $(this).closest('li').find('.location');
            var leftMarkers = [];

            $('.neighborhood-category.active').removeClass('active');
            $(this).addClass('active');

            categoryLocations.each(function() {
              var categoryLocation = $(this);
              const lat = categoryLocation.data('lat');
              const lng = categoryLocation.data('lng');

              $.each(locations, function(inx, location) {
                location.marker.setMap(null);

                if ((location.lat == lat) && (location.lng == lng)) {
                  leftMarkers.push(location.marker);
                }
              })
            });

            $.each(leftMarkers, function(inx, marker) {
              marker.setMap(map);
            });  

            // if no category has been selected
            isSelectedCategory = $('.neighborhood-category.active').length != 0;

            if (!isSelectedCategory) {
              $.each(locations, function(inx, location) {
                location.marker.setMap(map);
              });

              makeAllListLocationsInactive();
              if(activeInfoWindow) activeInfoWindow.close();
            }          
          });
        });        
      }


      function makeAllListLocationsInactive() {
        $.each(locations, function(inx, location) {
          location.locationDOM.removeClass('active');
        });
      } 

      return this;
    }
  };

  // expose to scope
  $.extend(theme, {
    PluginNeighborhoodMap: PluginNeighborhoodMap
  });

  // jquery plugin
  $.fn.themePluginNeighborhoodMap = function(opts) {
    return this.map(function() {
      var $this = $(this);

      if ($this.data(instanceName)) {
        return $this.data(instanceName);
      } else {
        return new PluginNeighborhoodMap($this, opts);
      }
    });
  }

}).apply(this, [window.theme, jQuery]);


(function($) {
  'use strict';

  $(document).ready(function() {
    var isMobile = false; //initiate as false
    // device detection
    if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
      || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
      isMobile = true;
    }

    // Parallax
    if ($.isFunction($.fn['themePluginParallax'])) {
      
      $('[data-parallax]:not(.manual)').each(function() {
        var $this = $(this),
            opts;

        var pluginOptions = theme.fn.getOptions($this.data('plugin-options'));
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginParallax(opts);
      });
    }    

    // lazyload
    if ($.isFunction($.fn.lazy)) {
      $('.lazy').lazy();
    }

    // date picker
    if ($.isFunction($.fn.datepicker)) {
      $('.calendar').each(function() {
        var $this = $(this);

        $this.datepicker({
          dateFormat: 'mm/dd/yy',
          showAnim: 'slideDown'
        });

        $this.datepicker('setDate', new Date());
      });
    }

    // accordion
    if ($.isFunction($.fn.accordion)) {

      $('.accordion').each(function() {
        var $this = $(this);

        $this.accordion({
          header: 'h3',
          animate: 400,
          collapsible: true,
          heightStyle: 'content',
          active: false,
          icons: { "header": "fas fa-plus", "activeHeader": "fas fa-minus" },
          activate: function(event, ui) {
            console.log(ui);
          }
        });
      });
    }

    // Owl carousel
    if ($.isFunction($.fn['themePluginOwlCarousel'])) {

      $('[data-owl-carousel]').each(function() {
        var $this = $(this),
            opts;

        var pluginOptions = theme.fn.getOptions($this.data('plugin-options'));
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginOwlCarousel(opts);
      });
    }


    // Isotope
    if ($.isFunction($.fn['themePluginIsotope'])) {

      $('[data-plugin-isotope]').each(function() {
        var $this = $(this),
            opts;

        var pluginOptions = theme.fn.getOptions($this.data('plugin-options'));
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginIsotope(opts);
      });
    }
    

    // Magnific Popup
    if ($.isFunction($.fn['themePluginMagnificPopup'])) {

      $('[data-magnific-popup]').each(function() {
        var $this = $(this),
            opts;

        var pluginOptions = theme.fn.getOptions($this.data('plugin-options'));
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginMagnificPopup(opts);
      });
    }


    // Video Popup
    if ($.isFunction($.fn['themePluginVideoPopup'])) {

      $('[data-plugin-video-popup]').each(function() {
        var $this = $(this),
            opts;

        var pluginOptions = theme.fn.getOptions($this.data('plugin-options'));
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginVideoPopup(opts);
      });
    }

    // Tabs
    if ($.isFunction($.fn['themePluginTabs'])) {

      $('[data-tabs]').each(function() {
        var $this = $(this),
            opts;

        var pluginOptions = theme.fn.getOptions($this.data('plugin-options'));
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginTabs(opts);
      });
    }

    // Google Map
    if ($.isFunction($.fn['themePluginGoogleMap'])) {

      $('[data-plugin-googlemap]').each(function() {
        var $this = $(this),
            opts;

        var pluginOptions = theme.fn.getOptions($this.data('plugin-options'));
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginGoogleMap(opts);
      });
    } 

    // Neighborhood Map
    if ($.isFunction($.fn['themePluginNeighborhoodMap'])) {

      $('[data-plugin-neighborhood-map]').each(function() {
        var $this = $(this),
            opts;

        var pluginOptions = theme.fn.getOptions($this.data('plugin-options'));
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginNeighborhoodMap(opts);
      });
    }       

  });
})(jQuery);