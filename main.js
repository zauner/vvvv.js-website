
var vvvviewer;
var page_mainloop;
var page_patch;
var current_patches = [];
var current_mainloops = [];

function hidePatch() {
  if (vvvviewer && vvvviewer!=undefined) {
    vvvviewer.destroy();
    delete vvvviewer;
    vvvviewer = undefined;
  }
  $('#patch').hide();
}

function attachShowPatchEvents() {
  $('.patch_link').unbind('click');
  $('.patch_link').click(function() {
    hidePatch();
    if ($(this).find('span').text()!='Hide') {
      $('.patch_link').find('span').text('Show');
      vvvviewer = new VVVV.VVVViewer(eval($(this).attr('href').split('#')[1]), '#patch');
      $('#patch').css('top', $(this).offset().top);
      $('#patch').show();
      $(this).find('span').text('Hide');
    }
    else
      $('.patch_link').find('span').text('Show');
    return false;
  });
}

$(document).ready(function() {
  //initVVVV('vvvv_js/', 'full');
  
  $('#main').hide();
  
  page_patch = new VVVV.Core.Patch("main.v4p", function() {
    page_mainloop = new VVVV.Core.MainLoop(this);
    $('#main').show();
  });
  
  attachShowPatchEvents();

});


function initSection(section_name) {

  console.log('oooooi'+section_name);

  for (var i=0; i<current_mainloops.length; i++) {
    current_mainloops[i].stop();
    delete current_mainloops[i];
    current_mainloops.splice(i, 1);
  }

  for (var i=0; i<current_patches.length; i++) {
    delete current_patches[i];
    current_patches.splice(i, 1);
  }

  switch (section_name) {
  
    case 0:
      current_patches.push(new VVVV.Core.Patch("teaser.v4p", function() {
        current_mainloops.push(new VVVV.Core.MainLoop(this));
        var v = new VVVV.VVVViewer(this, '#teaser_patch');
      }));
    break;
    
    case 1:
      $('#render_vvvviewer_demo').click(function() {
        current_patches.push(new VVVV.Core.Patch($('#patch1').text(), function() {
          var v = new VVVV.VVVViewer(this, '#patch1');
        }));
      });
    break;
    
    case 2:
      current_patches.push(new VVVV.Core.Patch("add.v4p", function() {
        current_mainloops.push(new VVVV.Core.MainLoop(this));
      }));
      current_patches.push(new VVVV.Core.Patch("attribute_example.v4p", function() {
        current_mainloops.push(new VVVV.Core.MainLoop(this));
      }));
      current_patches.push(new VVVV.Core.Patch("style_example.v4p", function() {
        current_mainloops.push(new VVVV.Core.MainLoop(this));
      }));
      attachShowPatchEvents();
    break;
  
    case 3:
      hidePatch();
      current_patches.push(new VVVV.Core.Patch("rotating_quads.v4p", function() {
        current_mainloops.push(new VVVV.Core.MainLoop(this));
      }));
      attachShowPatchEvents();
    break;
  
  }
}

