
var graph2;

$(document).ready(function() {
  //initVVVV('vvvv_js/', 'full');
  
  $('#main').hide();
  var vvvviewer;
  var page_mainloop;
  
  var graph = new VVVV.Core.Graph("main.v4p", function() {
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
      vvvviewer = new VVVV.VVVViewer(graph, '#pagepatch');
      $('#pagepatch').show();
      $(this).text("Hide this site's patch");
    }
  });
  
  
  
  window.setTimeout(5, function() {
    alert('stopped');
  });
  
  
  
});

