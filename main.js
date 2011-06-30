
var graph2;

$(document).ready(function() {
  //initVVVV('vvvv_js/', 'full');
  
  $('#main').hide();
  var vvvviewer;
  
  var graph = new VVVV.Core.Graph("main.v4p", function() {
    VVVV.Core.MainLoop.run(this);
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
  
  
  
});

