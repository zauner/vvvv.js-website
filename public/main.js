

$(document).ready(function() {
  VVVV.fps = 24;
  VVVV.init('/vvvv_js', 'full', function() {
  
  });
  
  $testcanvas = $('<canvas width="10" height="10"></canvas>');
  $('body').append($testcanvas);
  var webgl_enabled = false;
  try {
    var testctxt = $testcanvas.get(0).getContext("experimental-webgl");
    if (testctxt) {
      webgl_enabled = true;
    }
  }
  catch (x) { }
  $testcanvas.remove();

  if (!webgl_enabled) {
    $('.no-webgl').show();
    var i=1;
    window.setInterval(function() {
      i++;
      if (i>5) i=1;
      var $new_img = $('<img src="assets/fallback_header'+i+'.png">');
      $new_img.css('opacity', 0);
      $('.no-webgl img').after($new_img);
      $new_img.animate({opacity: 1.0}, {
        duration: 800,
        step: function() {
          $('.no-webgl img').first().css('opacity', 1.0 - $(this).css('opacity'));
        },
        complete: function() {
          $('.no-webgl img').first().remove();
        },
      });
    }, 6000);
  }
  
  function attachGalleryEvents() {
    $('#reload-gallery').click(function(e) {
      $.ajax({
        url: 'gallery?layout=false',
        success: function(response) {
          $('.gallery-item-list').html(response);
          attachGalleryEvents();
        }
      })
      
      e.preventDefault();
      return false;
    })
  }
  attachGalleryEvents();
  
  function openPage(url) {
    $.ajax({
      url: url+"?layout=false",
      success: function(response) {
        $('#contents').html(response);
        attachGalleryEvents();
        attachDownloadEvents();
        attachInlineLinkEvents('#contents a.internal');
      }
    })
  }
  
  function attachInlineLinkEvents(selector) {
    $(selector).click(function(e) {
      if ($(this).hasClass('external'))
        return true;
      openPage($(this).attr('href'));
      var url = $(this).attr('href');
      window.history.pushState({path: url}, url, url);
      e.preventDefault();
      return false;
    })
  }
  attachInlineLinkEvents('#menu li a');
  attachInlineLinkEvents('#contents a.internal');
  window.history.replaceState({path: location.href}, location.href, location.href);
  
  $(window).bind('popstate', function(e) {
    var state = e.originalEvent.state;
    console.log(state);
    if (state) {
      openPage(state.path);
    }
  });
  
  function attachDownloadEvents() {
    $('#download').magnificPopup({
      type: 'ajax',
      closeBtnInside: false,
      callbacks: {
        ajaxContentAdded: function() {
          PAYPAL.apps.ButtonFactory.create("vvvvjs@vvvvjs.com", {
            env: "sandbox",
            'return': "http://localhost/vvvv_js_page/index.php?page=download",
            tax: 0,
            shipping: 0,
            currency: "EUR",
            amount: "10.0",
            name: "VVVV.js",
            button: "buynow",
            rm: 2,
            no_shipping: 1,
            cbt: "Return to VVVV.js and start the download"
          }, "buynow", $('.usage_model').first().get(0));
          
          var slider = new Dragdealer('amount', {
            x: 9.0/300.0,
            animationCallback: function(x, y) {
              $(".paypal-button input[name='amount']").val(Math.round(x * 299)+1);
              $('#amount .handle').text((Math.round(x * 299)+1)+"EUR");
            }
          });
          
          var $paypal_disabler = $('<div style="position:absolute; top:0; left:0; width:100%; height: 100%; background:#F7F6EF; opacity: 0.8">');
          $("input[name='model']").change(function() {
            $("input[name='model']").each(function() {
              if ($(this).is(':checked')) {
                $(this).parent().removeClass('inactive');
                $(this).parent().find('a').removeClass('disabled');
                if ($(this).val()=='paid') {
                  slider.enable();
                  $paypal_disabler = $paypal_disabler.detach();
                } 
              }
              else {
                $(this).parent().addClass('inactive');
                $(this).parent().find('a').addClass('disabled');
                if ($(this).val()=='paid') {
                  slider.disable();
                  $(this).parent().find('form.paypal-button').append($paypal_disabler);
                }
              }
            });
          });
        }
      }
    });
  }
  attachDownloadEvents();

});