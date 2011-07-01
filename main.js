

$(document).ready(function() {
  //initVVVV('vvvv_js/', 'full');
  
  $('#main').hide();
  var vvvviewer;
  var page_mainloop;
  
  var patch = new VVVV.Core.Patch("main.v4p", function() {
    page_mainloop = new VVVV.Core.MainLoop(this);
    $('#main').show();
  });
  
  
  $('a#showpatch').click(function() {
    if (vvvviewer && vvvviewer!=undefined) {
      vvvviewer.destroy();
      delete vvvviewer;
      vvvviewer = undefined;
      $('#pagepatch').hide();
      $(this).text("Show this site's patch");
    }
    else {
      vvvviewer = new VVVV.VVVViewer(patch, '#pagepatch');
      $('#pagepatch').show();
      $(this).text("Hide this site's patch");
    }
  });
  
  
  
});


function initSection(section_name) {
  switch (section_name) {
  
    case 3:
      var webgl_patch = new VVVV.Core.Patch("rotating_quads.v4p", function() {
        webgl_mainloop = new VVVV.Core.MainLoop(this);
      });
    break;
  
  }
}

