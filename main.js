
var graph2;

$(document).ready(function() {
  //initVVVV('vvvv_js/', 'full');
  
  $('#main').hide();
  
  var graph = new VVVV.Core.Graph("main.v4p", function() {
    VVVV.Core.MainLoop.run(this);
    //var vvvviewer = new VVVV.VVVViewer(this, '#patch');
    $('#main').show();
  });
  
  
  
});

