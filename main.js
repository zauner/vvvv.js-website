
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
    
    case 6:
      var p = new VVVV.Core.Patch('');
      _(VVVV.Nodes).each(function(n) {
        var node = new n(0, p);
        var code = '<div class="node2">';
        code += '<a class="header" href="#">';
        code += '<div class="name">'+node.nodename+'</div>';
        var compatibility_rate = 0;
        if (node.meta)
          compatibility_rate = 100-node.meta.compatibility_issues.length*10;
        code += '<div class="compatibility_rate"><div style="width:'+compatibility_rate+'%"></div></div>';
        code += '<div style="clear:both"></div>';
        code += '</a>';
        code += '<div class="infos">';
        if (node.meta) {
          if (node.meta.authors.length>0)
            code += '<label>Author(s):</label><div class="data">'+node.meta.authors.join(', ')+'</div>';
          if (node.meta.original_authors.length>0)
            code += '<label>Original Node Author(s):</label><div class="data">'+node.meta.original_authors.join(', ')+'</div>';
          if (node.meta.compatibility_issues.length>0)
            code += '<label>Compatibility Issues:</label><div class="data">'+node.meta.compatibility_issues.join('<br> ')+'</div>';
          
        }
        else
          code += "No information found ...";
        code += "</div>";
        code += "</div>";
        
        $('#nodelist').append($(code));
      });
      $('#nodelist a.header').click(function() {
        $(this).next().toggle();
        return false;
      });
    break;
  
  }
}

